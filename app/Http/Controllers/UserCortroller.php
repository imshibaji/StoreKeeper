<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

/**
* @Middleware("web")
*/
class UserCortroller extends Controller
{

  /**
   * Show the Users List Page
   * @Get("users", middleware="auth", as="user list")
   *
   */
    public function list(){
      $users = User::all();
      return view('user.users', compact('users'));
    }
    /**
     * Show the Add User
     * @Get("/users/add", middleware="auth", as="user add")
     */
     public function add(){
       return view('user.add');
     }

     /**
      * Show the Add User
      * @Post("/users", middleware="auth", as="user save", name="useradd")
      */
     public function save(Request $request){
       $user = new User();

     }

    /**
     * Show the User Edit
     * @Get("/users/edit/{user}", middleware="auth", as="user edit", where={"user": "[0-9]+"})
     */
     public function edit(User $user){
       return $user;
     }

     /**
      * Show the Add User
      * @Put("/users", middleware="auth", as="user update")
      */
     public function update(Request $request, User $user){

     }

     /**
      * Show the User Delete
      * @Delete("/users/delete/{user}", middleware="auth", as="user Delete", where={"user": "[0-9]+"})
      */
      public function delete(User $user){
        return $user;
      }
}
