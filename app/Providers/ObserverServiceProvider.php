<?php

namespace App\Providers;

use App\Models\Assignee;
use App\Models\Board;
use App\Models\Definition;
use App\Models\Friendship;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Variable;
use App\Models\Vision;
use App\Observers\AssigneeObserver;
use App\Observers\BoardObserver;
use App\Observers\DefinitionObserver;
use App\Observers\FriendshipObserver;
use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Observers\UserObserver;
use App\Observers\VariableObserver;
use App\Observers\VisionObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Assignee::observe(AssigneeObserver::class);
        Board::observe(BoardObserver::class);
        Definition::observe(DefinitionObserver::class);
        Friendship::observe(FriendshipObserver::class);
        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
        User::observe(UserObserver::class);
        Variable::observe(VariableObserver::class);
        Vision::observe(VisionObserver::class);
    }
}
