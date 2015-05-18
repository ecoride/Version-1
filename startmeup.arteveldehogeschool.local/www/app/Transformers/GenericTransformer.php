<?php namespace StartMeUp\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Model;

class GenericTransformer extends TransformerAbstract
{
	public function transform(Model $model)
	{
		return $model->toArray();
	}
}
