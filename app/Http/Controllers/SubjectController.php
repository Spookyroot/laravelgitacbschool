<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use RealRashid\SweetAlert\Facades\Alert;


class SubjectController extends SearchableController
{
    private $title = 'Subject';

    function getQuery() 
    {
        return Subject::orderBy('code');
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
                            ->orWhere('sub_name', 'LIKE', "%{$word}%")
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
        session()->put('bookmark.course.view', $request->getUri());
        return view('subject.list', [
        'title' => "{$this->title} : List",
        'search' => $search,
        'subjects' => $query->paginate(5),
        ]);
    }

    function createForm(Request $request) 
{
    $this->authorize('create', Subject::class);
    $subjects = Subject::orderBy('code')->get();
    return view('subject.create-form', [
    'title' => "{$this->title} : Create",
    'subjects' => $subjects,
    ]);
    }


   /* function create(Request $request) 
    {
    $this->authorize('create', Subject::class);
    try {
        $subject = Subject::create($request->getParsedBody());
    return redirect()->route('subject.list')->with('status', "Subject {$subject->code} was created.");
    } catch(QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
    }*/

    function create(Request $request) 
    {
        $this->authorize('create', Subject::class);
        /*
        $data = $request->getParsedBody();
        $subject = new Subject();
        $subject->code = $data['code'];
        $subject->sub_name = $data['sub_name'];
        $subject->save();*/
        try {
            $subject = Subject::create($request->getParsedBody());
                        $this->authorize('create', Subject::class);
                        
                        $subject->fill($request->getParsedBody());
                        $subject->save();

                        return redirect()->route('subject.list', [
                            'subject' => $subject->code,
                            
                            ])->with('success', 'Created successfully!')
                            ; 
                    } catch(QueryException $subject) {
                        return redirect()->back()
                        ->with('errors','Error during the creation!');
                    } 

    /*return redirect()->route('subject.list')->with('status', 
    "Subject {$subject->sub_name} was created.");*/
    }

    function show($subjectCode) 
    {
        $subject = $this->find($subjectCode);
        return view('subject.view', [
        'title' => "{$this->title} : View",
        'subject' => $subject,
        ]);
    }

    function updateForm($subjectCode) {
        $this->authorize('update', Subject::class);
        $subject = $this->find($subjectCode);
        return view('subject.update-form', [
        'title' => "{$this->title} : Update",
        'subject' => $subject,
        ]);
        }

    function update(Request $request, $subjectCode) 
    {
        $this->authorize('update', Subject::class);
        try {
            $subject = $this->find($subjectCode);
        $subject->fill($request->getParsedBody());
        $subject->save();
            return redirect()->route('subject.view', [
                'subject' => $subject->code,
                ])->with('success', 'Updated successfully!')
                ; 
            } catch(QueryException $subject) {
                return redirect()->back()
                ->with('errors','Error during the creation!');
            }
        }

        function delete($subjectCode) 
        {
    $subject = $this->find($subjectCode);
    {
        $this->authorize('delete', Subject::class);
            $subject = $this->find($subjectCode);
        $subject->delete();
           return redirect()->route('subject.list', [
            'subject' => $subject->code,
            ])->with('success', 'Deleted successfully!')
            ; 
    
    
        }}

            function showCourse(Request $request, CourseController $courseController, $subjectCode)
                            {
                            $subject = $this->find($subjectCode);
                            $search = $courseController->prepareSearch($request->getQueryParams());
                            $query = $courseController->filterBySearch($subject->courses(), $search);
                            session()->put('bookmark.course.view', $request->getUri());
                            return view('subject.view-product', [
                            'title' => "{$this->title} {$subject->name} : Course",
                            'subject' => $subject,
                            'search' => $search,
                            'course' => $query->paginate(5),
                            ]);
                            }

                            function addCourseForm(Request $request,CourseController $courseController,$subjectCode) 
                            {
                                $this->authorize('update', Subject::class);
                                $subject = $this->find($subjectCode);
                                $query = Course::orderBy('code')->whereDoesntHave
                                ('subject',
                                function($innerQuery) use ($subject)
                                {
                                    return $innerQuery->where('code', $subject->code);
                                });

                                $search = $courseController->prepareSearch($request->getQueryParams());
                                $query = $courseController->filterBySearch($query, $search);

                                return view('subject.add-course-form', [
                                    'title' => "{$this->title} {$subject->name} : Add Course",
                                    'search' => $search,
                                    'subject' => $subject,
                                    'courses' => $query->paginate(5),
                                ]);
                                
                            }

                            function addCourse(
                                Request $request,
                                CourseController $courseController,
                                $subjectCode
                            ) {
                                $this->authorize('update', Subject::class);

                                try {
                                    $subject = $this->find($subjectCode);
                                $data = $request->getParsedBody();
                                $course = $courseController->find($data['course']);
                                $course->subject()->associate($subject);
                                $course->save();
                        
                                return redirect()->back()
                                ->with('status', "Course {$course->name} was added to Subject {$subject->name}.");
                                } catch(QueryException $excp) {
                                    return redirect()->back()->withInput()->withErrors([
                                        'error' => $excp->errorInfo[2],
                                    ]);
                                }
                            
                            }

                            public function __construct() {
                                $this->middleware('auth');
                                }
                            }
