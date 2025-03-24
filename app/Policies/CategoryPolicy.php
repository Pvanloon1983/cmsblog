<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function index(User $user, Category $category)
    {
        return $user->id === $category->user_id;
    }

    public function update(User $user, Category $category)
    {
        return $user->id === $category->user_id;
    }

    public function delete(User $user, Category $category)
    {
        return $user->id === $category->user_id;
    }

    public function edit(User $user, Category $category)
    {
        return $user->id === $category->user_id;
    }
}
