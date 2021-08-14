<?php 
namespace App\Controllers\Admin;
use App\Middlewares\AdminAuthMiddleware;
use Fantom\Controller;


/**
 * 
 */
class HomeController extends Controller
{
	protected function index()
	{
		$this->view->render("Admin/Home/index.php");
	}


	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}

?>

