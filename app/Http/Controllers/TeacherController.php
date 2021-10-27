<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends SearchableController
{
    private $title = 'Teacher';

    function getQuery() 
    {
        return Teacher::orderBy('code');
        }

        function filterByTerm($query, $term) 
        {
            if(!empty($term)) 
            {
            foreach(preg_split('/\s+/', $term) as $word) 
                {
                    $query->where(function($innerQuery) use ($word)
                        {
                            return $innerQuery
                            ->where('code', 'LIKE', "%{$word}%")
                            ->orWhere('t_firstname', 'LIKE', "%{$word}%")
                            ->orWhere('t_lastname', 'LIKE', "%{$word}%")
                            ->orWhere('t_lastname', 'LIKE', "%{$word}%")
                            ->orWhere('subject_id', 'LIKE', "%{$word}%")
                            ->orWhere('id', 'LIKE', "%{$word}%");
                        });
                }
            }
            return $query;
        }
    
            function prepareSearch($search) {
                $search['term'] = (empty($search['term']))? null : $search['term'];
                return $search;
                }
                function filterBySearch($query, $search) {
                    return $this->filterByTerm($query, $search['term']);
                    }
                    
                    function search($search) {
                    $query = $this->getQuery();
                    return $this->filterBySearch($query, $search);
                    }
                
                function find($code) {
                return $this->getQuery()->where('code', $code)->firstOrFail();
                }

        function list(Request $request) 
        {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search);
        session()->put('bookmark.teacher.view', $request->getUri());
        return view('teacher.list', [
        'title' => "{$this->title} : List",
        'search' => $search,
        'teachers' => $query->paginate(5),
        ]);
}

function createForm(Request $request) 
{
    $this->authorize('create', Teacher::class);
    $subjects = Subject::orderBy('code')->get();
    return view('teacher.create-form', [
    'title' => "{$this->title} : Create",
    'subjects' => $subjects,
    ]);
    }

   /* function create(Request $request) 
    {
    $this->authorize('create', Teacher::class);
    
    try {
        $teacher = Teacher::create($request->getParsedBody());
        return redirect()->route('teacher.list')->with('status', "Teacher {$teacher->code} was created.");
    } catch(QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }*/
    function create(Request $request) 
    {
        $this->authorize('create', Teacher::class);
        try {
            $teacher = Teacher::create($request->getParsedBody());
                    $this->authorize('create', Teacher::class);
                    
                    $teacher->fill($request->getParsedBody());
                    $teacher->save();
        
        return redirect()->route('teacher.list', [
            'course' => $teacher->code,
            
            ])->with('success', 'Created successfully!')
            ; 
    } catch(QueryException $teacher) {
        return redirect()->back()
        ->with('errors','Error during the creation!');
    } 
} 

    function show($teacherCode) 
    {
        $teacher = $this->find($teacherCode);
        return view('teacher.view', [
        'title' => "{$this->title} : View",
        'teacher' => $teacher,
        ]);
    }


    function updateForm($teacherCode) {
        $this->authorize('update', Teacher::class);
        $teacher = $this->find($teacherCode);
        $subjects = Subject::orderBy('code')->get();

        return view('teacher.update-form', [
        'title' => "{$this->title} : Update",
        'teacher' => $teacher,
        'subjects' => $subjects,
        ]);
        }

    function update(Request $request, $teacherCode) 
    {
        $this->authorize('update', Teacher::class);
        try {
            $teacher = $this->find($teacherCode);
        $teacher->fill($request->getParsedBody());
        $teacher->save();
            return redirect()->route('teacher.view', [
                'teacher' => $teacher->code,
                ])->with('success', 'Updated successfully!')
                ; 
            } catch(QueryException $teacher) {
                return redirect()->back()
                ->with('errors','Error during the creation!');
            }
    
        }

        function delete($teacherCode) 
        {
            $this->authorize('delete', Course::class);
                $teacher = $this->find($teacherCode);
            $teacher->delete();
               return redirect()->route('course.list', [
                'teacher' => $teacher->code,
                ])->with('success', 'Deleted successfully!')
                ; 
        
        
            }

            function showCourse(Request $request, CourseController $courseController, $teacherCode)
                            {
                            $teacher = $this->find($teacherCode);
                            $search = $courseController->prepareSearch($request->getQueryParams());
                            $query = $courseController->filterBySearch($teacher->courses(), $search);
                            session()->put('bookmark.course.view', $request->getUri());
                            return view('teacher.view-course', [
                            'title' => "{$this->title} {$teacher->code} : Course",
                            'teacher' => $teacher,
                            'search' => $search,
                            'course' => $query->paginate(5),
                            ]);
                            }

                            function addCourseForm(Request $request,CourseController $courseController,$teacherCode) 
                            {
                                $this->authorize('update', Teacher::class);
                                $teacher = $this->find($teacherCode);
                                $query = Course::orderBy('code')->whereDoesntHave
                                ('teachers',
                                function($innerQuery) use ($teacher)
                                {
                                    return $innerQuery->where('code', $teacher->code);
                                });

                                $search = $courseController->prepareSearch($request->getQueryParams());
                                $query = $courseController->filterBySearch($query, $search);

                                return view('teacher.add-course-form', [
                                    'title' => "{$this->title} {$teacher->code} : Add Product",
                                    'search' => $search,
                                    'teacher' => $teacher,
                                    'courses' => $query->paginate(5),
                                ]);
                                
                            }

                            function addCourse(
                                Request $request,
                                CourseController $courseController,
                                $teacherCode
                            ) {
                                $this->authorize('update', Teacher::class);

                                try {
                                    $teacher = $this->find($teacherCode);
                                $data = $request->getParsedBody();
                                $course = $courseController->find($data['course']);
                                $teacher->courses()->attach($course);
                        
                                return redirect()->back()
                                ->with('status', "Course {$course->code} was added to  {$teacher->code}.");
                                } catch(QueryException $excp) {
                                    return redirect()->back()->withInput()->withErrors([
                                        'error' => $excp->errorInfo[2],
                                    ]);
                                }
                            
                            }
                        
                            function removeCourse($teacherCode, $courseCode)
                            {
                                $this->authorize('update', Teacher::class);
                                try {
                                    $teacher = $this->find($teacherCode);
                                $course = $teacher->courses()
                                    ->where('code', $courseCode)
                                    ->firstOrFail()
                                ;
                                $teacher->courses()->detach($course);
                        
                                return redirect()->back()
                                ->with('status', "Product {$course->code} was deleted to Shop {$teacher->code}.");
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

