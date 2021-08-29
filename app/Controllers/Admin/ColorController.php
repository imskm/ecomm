<?php 
namespace App\Controllers\Admin;



use App\EComm\Validators\ColorValidator;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Color;
use Fantom\Controller;
use Fantom\Session;

/**
 * 
 */
class ColorController extends Controller

{
	
	protected function index()
	{
		$colors = Color::recent(get_page())->get();
		$this->view->render('Admin/Color/index.php',[
			"colors" =>$colors,
		]);
	}

	protected function create()
	{
		$this->view->render('Admin/Color/create.php');
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
		$color = Color::make($_POST);

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


	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}