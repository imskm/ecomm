<?php 

namespace App\Controllers\Admin;
use App\EComm\Repositories\CategoryRepository;
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
		$category = CategoryRepository::recent(get_page())->get();

		$this->view->render("Admin/Category/index.php",[
			"categories" => $category,
		]);
	}

	protected function create()
	{
		$this->view->render("Admin/Category/create.php");
	}

	protected function edit()
	{
		$category_id = (int) $this->route_params['id'];
		
		$category = CategoryRepository::find($category_id);
		if(is_null($category))
		{
			Session::flash("error","Category with Id '{$category_id}' is not Found");
			redirect("admin/catehgory/index");
		}

		$this->view->render("Admin/Category/edit.php",[
			"category" => $category
		]);
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

		$category = CategoryRepository::make($_POST);

		if($category->save() === false)
		{
			Session::flash("Error","Failed to create Category");
			redirect("admin/category/create");
		}

		Session::flash("success","Category Created Successfully");
		redirect("admin/category/index");
	}

	protected function update()
	{
		$v = new CategoryValidator();
		$v->validateUpdate();
		$category_id = (int) post_or_empty("id");

		if($v->hasError())
		{
			redirect("admin/category/{$category_id}/edit");
		}

		$category = CategoryRepository::find($category_id);
		CategoryRepository::change($category, $_POST);
		if($category->save() == false)
		{
			Session::flash("error","Failed to Update Category");
			redirect("admin/category/{$category_id}/edit");
		}
		Session::flash("success","Category Upadated Successfully");
		redirect("admin/category/index");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}