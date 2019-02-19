<?php

namespace App\Repositories;

class UserInterface implements RepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return User::find($id);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }



    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id)
    {
        User::destroy($id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($post_id, array $post_data)
    {
        Post::find($id)->update($post_data);
    }
}
