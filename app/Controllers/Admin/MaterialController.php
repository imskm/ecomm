<?php 

namespace App\Controllers\Admin;
use App\EComm\Validators\MaterialValidator;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Material;
use Fantom\Controller;
use Fantom\Session;


/**
 * 
 */
class MaterialController extends Controller
{
	protected function index()
	{
		$materials = Material::recent(get_page())->get();
			
		$this->view->render("Admin/Material/index.php",[
			"materials" => $materials,
		]);
	}

	protected function create()
	{
		$this->view->render("Admin/Material/create.php");
	}

	protected function store()
	{
		$v = new MaterialValidator();
		$v->validateMaterialCreate();

		if($v->hasError())
		{
			redirect('admin/material/create');
		}
		$material = Material::make($_POST);

		if($material->save() === false)
		{
			Session::flash("error","Material is Not Created");
			redirect("admin/material/create");
		}
		Session::flash("success", "Material is Created Successfuly");
		redirect("admin/material/index");
	}


	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
	
}

?>