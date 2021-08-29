<?php 

namespace App\Controllers\Admin;
use App\EComm\Validators\CategoryValidator;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Category;
use Fantom\Controller;
use Fantom\Session;

/**
 * 
 */
class CategoryController extends Controller
{
	
	protected function index()
	{
		$category = Category::recent(get_page())->get();

		$this->view->render("Admin/Category/index.php",[
			"categories" => $category,
		]);
	}

	protected function create()
	{
		$this->view->render("Admin/Category/create.php");
	}

	protected function store()
	{
		// Validation
		$v = new CategoryValidator();
		$v->validateCreate();
		if($v->hasError())
		{
			redirect("admin/category/create");
		}

		$category = Category::make($_POST);

		if($category->save() === false)
		{
			Session::flash("Error","Failed to create Category");
			redirect("admin/category/create");
		}

		Session::flash("success","Category Created Successfully");
		redirect("admin/category/index");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}