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

	protected function edit()
	{
		$material_id =(int) $this->route_params['id'];
		$material = Material::find($material_id)->first();

		if(is_null($material))
		{
			Session::flash("error","Material with Id '{$material_id}' is Not Found");
			redirect("admin/material/index");
		}
		$this->view->render('Admin/Material/edit.php',[
			"material" => $material
		]);
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

	protected function update()
	{
		$v = new MaterialValidator();
		$v->validateUpdate();

		$material_id = (int) post_or_empty("id");
		if($v->hasError())
		{
			redirect("admin/material/{$material_id}/edit");
		}

		$material = Material::find($material_id)->first();
		Material::change($material, $_POST);
		if($material->save() === false)
		{
			Session::flash("error","Failed to Update material");
			redirect("admin/material/{$material_id}/edit");
		}

		Session::flash("success","Material is Updated Successfully");
		redirect("admin/material/index");

	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
	
}

?>