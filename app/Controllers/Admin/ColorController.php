<?php 

namespace App\Controllers\Admin;

use Fantom\Session;
use Fantom\Controller;
use App\EComm\Validators\ColorValidator;
use App\Middlewares\AdminAuthMiddleware;
use App\EComm\Repositories\ColorRepository;

/**
 * 
 */
class ColorController extends Controller
{
	protected function index()
	{
		$colors = ColorRepository::recent(get_page())->get();
		$this->view->render('Admin/Color/index.php',[
			"colors" =>$colors,
		]);
	}

	protected function create()
	{
		$this->view->render('Admin/Color/create.php');
	}

	protected function edit()
	{
		$color_id = (int) $this->route_params['id'];

		$color = ColorRepository::find($color_id);

		if(is_null($color))
		{
			Session::flash("error","Color With Id '{$color_id}' is Not Found");
			redirect("admin/color/index");
		}

		$this->view->render("Admin/Color/edit.php",[
			"color" => $color
		]);
	}

	protected function store()
	{
		// 1 Validate

		$v = new ColorValidator();
		$v->validateCreate();
		if($v->hasError())
		{
			redirect('admin/color/create');
		}
		// 2  Make Model 
		$color = ColorRepository::make($_POST);

		// 3 
		if($color->save() === false)
		{
			Session::flash("error","Failed to Create Color");
			redirect("admin/color/create");
		}

		// 4 success mesage after submit the data and redirect

		Session::flash("success","Color Created Successfully");
		redirect("admin/color/index");
	}

	protected function update()
	{
		$v = new ColorValidator();
		$v->validateUpdate();

		$color_id = (int) post_or_empty("id");
		if($v->hasError())
		{
			redirect("admin/color/{$color_id}/edit");
		}
		
		$color = ColorRepository::find($color_id);
		ColorRepository::change($color,$_POST);

		if($color->save() == false)
		{
			Session::flash("error","Failed to Update the Color");
			redirect("admin/color/{$color_id}/edit");
		}
		Session::flash("success","Color is Update successfully");
		redirect("admin/color/index");

	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}
