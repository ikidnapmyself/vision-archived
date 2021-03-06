<?php
namespace App\Traits;

use App\Models\Status;
use Spatie\ModelStatus\HasStatuses as BaseTrait;

trait HasStatuses
{
    use BaseTrait;

    /**
     * Pre-defined statuses.
     *
     * @var array $allowedStatuses
     */
    private $allowedStatuses = [];

    /**
     * This method is called upon instantiation of the Eloquent Model.
     *
     * @return void
     */
    public function initializeHasStatuses()
    {
        $this->allowedStatuses = config('model-status.allowed_statuses');
        $this->append(['available_statuses', 'current_status']);
    }

    /**
     * Boot model class.
     */
    protected static function bootHasStatuses()
    {
        static::created(function ($model) {
            /*
             * @var \Illuminate\Database\Eloquent\Model
             */
            /**
             * @todo Reason on created might change
             */
            $model->setStatus('inbox', __('status.reasons.default'));
        });
        static::retrieved(function ($model) {
            $model->fillable = array_merge($model->fillable, ['available_statuses', 'status']);
        });
    }

    /**
     * Custom status validation.
     *
     * @param string $name
     * @param string|null $reason
     * @return bool
     */
    public function isValidStatus(string $name, ?string $reason = null): bool
    {
        return in_array($name, $this->allowedStatuses);
    }

    /**
     * Available statuses. (note: override if there is a workflow or business logic)
     *
     * @return array
     */
    public function availableStatuses(): array
    {
        return $this->allowedStatuses;
    }

    /**
     * Available statuses. (note: override if there is a workflow or business logic)
     *
     * @return array
     */
    public function getAvailableStatusesAttribute(): array
    {
        return $this->availableStatuses();
    }

    /**
     * Return current status.
     *
     * @return Status|null
     */
    public function getCurrentStatusAttribute(): ?Status
    {
        return $this->latestStatus();
    }
}
