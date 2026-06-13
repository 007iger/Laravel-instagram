<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_posts         = $this->getHomePosts();
        $suggested_users    = $this->getSuggestedUsers();

        return view('users.home')
                ->with('home_posts', $home_posts)
                ->with('suggested_users', $suggested_users);
    }

    public function getHomePosts(){


        $all_posts = $this->post->latest()->get();
        # Same as: "SELECT * FROM posts ORDER BY created_at DESC";
        
        $home_posts = [];
        # Purpose: In case the $home_posts above is empty, it will not return NULL, but empty instead

        foreach ($all_posts as $post) {
            if ($post->user->isFollowed() || $post->user->id === Auth::user()->id) {
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }

    private function getSuggestedUsers(){
        
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach ($all_users as $user) {
            # Check if the user is already being followed by the Auth USER
            if (! $user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }

        return array_slice($suggested_users, 0, 5);
        # array_slice(x,y,z)
        # x ---> array
        # y ---> offset/starting index
        # z ---> length/how many users to display?
    }

    public function getAllUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach ($all_users as $user) {
            # Check if the user is already being followed by the Auth USER
            if (! $user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }
        return view('users.suggestion')
                ->with('suggested_users', $suggested_users);
    }

    public function search(Request $request){
        $users = $this->user->where('name', 'like', '%' . $request->search . '%')->get();

        return view('users.search')
                ->with('users', $users)
                ->with('search', $request->search);
    }
}
