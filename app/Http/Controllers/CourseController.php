<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
Use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use RealRashid\SweetAlert\Facades\Alert;


class CourseController extends SearchableController
{
    private $title = 'Course';

    function getQuery() 
    {
        return Course::orderBy('code');
        }
     
        function list(Request $request) 
        {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search)->withCount('teacher');
        $subjects = Subject::orderBy('code')->get();
        session()->put('bookmark.course.view', $request->getUri());
        return view('course.list', [
        'title' => "{$this->title} : List",
        'search' => $search,
        'subjects' => $subjects,
        'courses' => $query->paginate(5),
        ]);
    }

function createForm(Request $request) 
{
    $this->authorize('create', Course::class);
    $subjects = Subject::orderBy('code')->get();
    return view('course.create-form', [
    'title' => "{$this->title} : Create",
    'subjects' => $subjects,
    ]);
    }

    function create(Request $request) 
    {
        $this->authorize('create', Course::class);
        try {
                $course = Course::create($request->getParsedBody());
                        $this->authorize('create', Course::class);
                        
                        $course->fill($request->getParsedBody());
                        $course->save();

            return redirect()->route('course.list', [
                'course' => $course->code,
                
                ])->with('success', 'Created successfully!')
                ; 
        } catch(QueryException $course) {
            return redirect()->back()
            ->with('errors','Error during the creation!');
        } 
} 
    
    

    function show($courseCode) 
    {
        $course = $this->find($courseCode);
        $subjects = Subject::orderBy('code')->get();
        return view('course.view', [
        'title' => "{$this->title} : View",
        'course' => $course,
        'subjects' => $subjects,
        ]);
    }

    function updateForm($courseCode) {
        $this->authorize('update', Course::class);
        $course = $this->find($courseCode);
        $subjects = Subject::orderBy('code')->get();

        return view('course.update-form', [
        'title' => "{$this->title} : Update",
        'course' => $course,
        'subjects' => $subjects,
        ]);
        }

    function update(Request $request, $courseCode) 
    {
        $this->authorize('update', Course::class);
        
        try {
            $course = $this->find($courseCode);
        $course->fill($request->getParsedBody());
        $course->save();
            return redirect()->route('course.view', [
                'course' => $course->code,
                ])->with('success', 'Updated successfully!')
                ; 
            } catch(QueryException $course) {
                return redirect()->back()
                ->with('errors','Error during the creation!');
            }
    
        }

        function delete($courseCode) 
        {
            $this->authorize('delete', Course::class);
                $course = $this->find($courseCode);
            $course->delete();
               return redirect()->route('course.list', [
                'course' => $course->code,
                ])->with('success', 'Deleted successfully!')
                ; 
        
        
            }

        function prepareSearch($search) 
        {
                $search = parent::prepareSearch($search);
                $search = array_merge([
                'minPrice' => null,
                'maxPrice' => null,
                ], $search);
                return $search;
                }

                function filterByPrice($query, $minPrice, $maxPrice) {
                    if($minPrice!== null) {
                    $query->where('price', '>=', $minPrice);
                    }
                    if($maxPrice!== null) {
                    $query->where('price', '<=', $maxPrice);
                    }
                    return $query;
                    }

                    function filterBySearch($query, $search) {
                        $query = parent::filterBySearch($query, $search);
                        $query = $this->filterByPrice($query,
                        $search['minPrice'], $search['maxPrice']);
                        return $query;
                        }

                        function showTeacher(Request $request, TeacherController $teacherController, $courseCode)
                            {
                            $course = $this->find($courseCode);
                            $search = $teacherController->prepareSearch($request->getQueryParams());
                            $query = $teacherController->filterBySearch($course->teachers(), $search);
                            session()->put('bookmark.teacher.view', $request->getUri());
                            return view('course.view-teacher', [
                            'title' => "{$this->title} {$course->code} : Shop",
                            'course' => $course,
                            'search' => $search,
                            'teachers' => $query->paginate(5),
                            ]);
                            }

                            function addTeacherForm(Request $request,TeacherController $teacherController,$courseCode) 
                            {
                                $this->authorize('update', Course::class);
                                $course = $this->find($courseCode);
                                $query = Teacher::orderBy('code')->whereDoesntHave
                                ('courses',
                                function($innerQuery) use ($course)
                                {
                                    return $innerQuery->where('code', $course->code);
                                });

                                $search = $teacherController->prepareSearch($request->getQueryParams());
                                $query = $teacherController->filterBySearch($query, $search);

                                return view('course.add-teacher-form', [
                                    'title' => "{$this->title} {$course->code} : Add Teacher",
                                    'search' => $search,
                                    'course' => $course,
                                    'teachers' => $query->paginate(5),
                                ]);
                                
                            }

                            function addTeacher(
                                Request $request,
                                TeacherController $teacherController,
                                $courseCode
                            ) {
                                $this->authorize('update', Course::class);
                        
                                try {
                                    $course = $this->find($courseCode);
                                $data = $request->getParsedBody();
                                $teacher = $teacherController->find($data['teacher']);
                                $course->teachers()->attach($teacher);
                                    return redirect()->back()
                                ->with('status', "Teacher {$teacher->code} was added to Product {$course->code}.");
                                } catch(QueryException $excp) {
                                    return redirect()->back()->withInput()->withErrors([
                                        'error' => $excp->errorInfo[2],
                                    ]);
                                }
                            
                            }
                        
                            function removeTeacher($courseCode, $teacherCode) {
                                $this->authorize('update', Course::class);
                        
                                try {
                                    $course = $this->find($courseCode);
                                $teacher = $course->teachers()
                                    ->where('code', $teacherCode)
                                    ->firstOrFail()
                                ;
                                $course->teachers()->detach($teacher);
                                    return redirect()->back()
                                ->with('status', "Teacher {$teacher->code} was removed to Course {$course->code}.");
                                } catch(QueryException $excp) {
                                    return redirect()->back()->withErrors([
                                        'error' => $excp->errorInfo[2],
                                    ]);
                                }
                            
                            }
                        
    public function __construct()
    {
        $this->middleware('auth');
    }
}