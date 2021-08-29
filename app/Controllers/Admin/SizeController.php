<?php 
namespace App\Controllers\Admin;
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
		$sizes = Size::recent(get_page())->get();

		$this->view->render("Admin/Size/index.php",[
			"sizes" => $sizes,
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

		$size = Size::make($_POST);

		// Save the data to the database

		if($size->save() === false)
		{
			Session::flash("error","Failed to Create Size");
			redirect("admin/size/index");
		} 
		Session::flash("success","Size Created Successfully");
		redirect("admin/size/index");

	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
	
}