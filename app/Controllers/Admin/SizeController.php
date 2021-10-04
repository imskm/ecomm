<?php 
namespace App\Controllers\Admin;
use App\EComm\Repositories\SizeRepository;
use App\EComm\Validators\SizeValidator;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Size;
use Fantom\Controller;
use Fantom\Session;

/**
 * 
 */
class SizeController extends Controller
{
	protected function index()
	{
		$sizes = SizeRepository::recent(get_page())->get();

		$this->view->render("Admin/Size/index.php",[
			"sizes" => $sizes,
		]);
	}

	protected function edit()
	{
		$size_id = (int) $this->route_params['id'];
		$size = SizeRepository::find($size_id);

		if(is_null($size))
		{
			Session::flash("error","Size with Id '{$size_id}' is not Found");
			redirect("admin/size/index");
		}

		$this->view->render("Admin/Size/edit.php",[
			"size" => $size
		]);
	}

	protected function create()
	{
		$this->view->render('Admin/Size/create.php');
	}

	protected function store()
	{
		// 1. Validate 

		$v = new SizeValidator();
		$v->validateCreate();
		if($v->hasError())
		{
			redirect('admin/size/create');
		}

		// 2. Make Size Model

		$size = SizeRepository::make($_POST);

		// Save the data to the database

		if($size->save() === false)
		{
			Session::flash("error","Failed to Create Size");
			redirect("admin/size/index");
		} 
		Session::flash("success","Size Created Successfully");
		redirect("admin/size/index");

	}

	protected function update()
	{
		$v = new SizeValidator();
		$v->validateUpdate();
		$size_id = (int) post_or_empty("id");

		

		if($v->hasError())
		{
			redirect("admin/size/{$size_id}/edit");
		}

		$size = SizeRepository::find($size_id);

		SizeRepository::change($size,$_POST);
		if($size->save()===false)
		{
			Session::flash("error","Failed to Update size");
			redirect("admin/size/{$size_id}/edit");
		}

		Session::flash("success","Size Updated Successful");
		redirect("admin/size/index");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
	
}