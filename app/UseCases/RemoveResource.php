<?php

namespace App\UseCases;

class RemoveResource
{
    /**
     * Perform deletion.
     *
     * @param  string $modelName
     * @param  \App\Model $instance
     * @return void
     */
    public static function perform($modelName, $instance)
    {
        (new static)->handleDeletion($modelName, $instance);
    }

    /**
     * Handle a delete request.
     *
     * @param  string $modelName
     * @param  \App\Model|null $instance
     * @return void
     */
    private function handleDeletion($modelName, $instance = null)
    {
       $instance ? $this->deleteSingle($modelName, $instance)
                 : $this->deleteMultiple($modelName);
    }

    /**
     * Remove multiple resources from storage.
     *
     * @return void
     */
    private function deleteMultiple($modelName)
    {
        collect($this->getResources($modelName))->each(function ($resource) use($modelName)
        {
            $this->deleteSingle($modelName, $resource);
        });
    }

    /**
     * Delete a single resurce from storage.
     *
     * @param  string $modelName
     * @param  \App\Model $instance
     * @return void
     */
    private function deleteSingle($modelName, $instance)
    {
        // $modelName == 'Doctor' ? $instance->remove() : $instance->delete();
        $instance->delete();
    }

    /**
     * Get resources for a specific model.
     *
     * @param  string $modelName
     * @return array
     */
    private function getResources($modelName)
    {
        $model = $this->getModel($modelName);

        return $model::findMany(request('ids'));
    }

    /**
     * Get the model.
     *
     * @param  string $name
     * @return string
     */
    private function getModel($name)
    {
        return 'App\\' . $name;
    }
}
