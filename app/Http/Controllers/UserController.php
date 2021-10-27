<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends SearchableController
{
    private $title = 'User';

    function getQuery() 
    {
        return User::orderBy('id');
        }

        public function filterByTerm($query, $term)
        {
               if(!empty($term)) {
                   $words = preg_split('/\s+/', $term);
       
                   foreach($words as $word) {
                       $query->where(function($innerQuery) use ($word) {
                           return $innerQuery
                                   ->where('name','LIKE',"%{$word}%")
                                   ->orWhere('email','LIKE',"%{$word}%")
                                   ->orWhere('role','LIKE',"%{$word}%");
       
                       });
                   }
               }
              return $query;
        }

        function find($email) {
            return $this->getQuery()->where('email', $email)->firstOrFail();
            }

        function list(Request $request) 
        {
            $this->authorize('list', User::class);
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search);
        session()->put('bookmark.user.view', $request->getUri());
        return view('user.list', [
        'title' => "{$this->title} : List",
        'search' => $search,
        'users' => $query->paginate(5),
        ]);
    }

    function createForm(Request $request) 
{
    $this->authorize('create', User::class);
    $users = User::orderBy('id')->get();
    return view('user.create-form', [
    'title' => "{$this->title} : Create",
    'users' => $users,
    ]);
    }

    function create(Request $request) 
    {
        $this->authorize('create', User::class);
    /*$data = $request->getParsedBody();
    $user = new User();
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user-> role = $data['role'];
    $user->password = Hash::make($data['password']); 
    $user->save();
    return redirect()->route('user.list')->with('status', "User {$user->email} was created.");
    }*/
    try {
        $user = User::create($request->getParsedBody());
                $this->authorize('create', User::class);
                
                $user->fill($request->getParsedBody());
                $user->save();

    return redirect()->route('user.list', [
        'user' => $user->email,
        
        ])->with('success', 'Created successfully!')
        ; 
} catch(QueryException $user) {
    return redirect()->back()
    ->with('errors','Error during the creation!');
} 
} 

    function show($userEmail) 
    {
        $this->authorize('show', User::class);
        $user = $this->find($userEmail);
        return view('user.view', [
        'title' => "{$this->title} : View",
        'user' => $user,
        ]);
    }

    function updateForm($userEmail) {
        $this->authorize('update', User::class);
        $user = $this->find($userEmail);
       /* return view('user.update-form', [
        'title' => "{$this->title} : Update",
        'user' => $user,
        ]);
        }*/
        return view('user.update-form', [
            'title' => "{$this->title} : Update",
            'user' => $user,
            
            ]);
            }

    function update(Request $request, $userEmail) 
    {
        $this->authorize('update', User::class);
        
        try {
            $user = $this->find($userEmail);
        $user->fill($request->getParsedBody());
        $user->save();
            return redirect()->route('user.view', [
                'user' => $user->email,
                ])->with('success', 'Updated successfully!')
                ; 
            } catch(QueryException $user) {
                return redirect()->back()
                ->with('errors','Error during the update!');
            }
    
        }

        function delete($userEmail) 
        {
            $this->authorize('delete', User::class);
            $user = $this->find($userEmail);
            $user->delete();
            return redirect()->route('user.list', [
                'user' => $user->email,
                ])->with('success', 'Deleted successfully!')
                ;
            }
            public function __construct()
    {
        $this->middleware('auth');
    }
        }
