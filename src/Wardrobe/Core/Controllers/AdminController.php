<?php namespace Wardrobe\Core\Controllers;

use View, Config, Input, Auth;

use Wardrobe\Core\Repositories\UserRepositoryInterface;

class AdminController extends BaseController {

	/**
	 * The user repository implementation.
	 *
	 * @var Wardrobe\UserRepositoryInterface
	 */
	protected $users;

	/**
	 * Create a new admin controller instance.
	 *
	 * @param UserRepositoryInterface $users
	 *
	 * @return AdminController
	 */
	public function __construct(UserRepositoryInterface $users)
	{
		parent::__construct();

		$this->users = $users;

		$this->beforeFilter('wardrobe.auth');
	}

	/**
	 * Get the main admin view.
	 */
	public function index()
	{
		return View::make('core::admin.index')
			->with('users', $this->users->all())
			->with('user', Auth::user())
			->with('locale', $this->loadLanguage());
	}

	/**
	 * Load the designated language file
	 */
	protected function loadLanguage()
	{
		$locale = require app_path().'/lang/'.Config::get('app.locale').'/wardrobe.php';
		return $locale;
	}
}
