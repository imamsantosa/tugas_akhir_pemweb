<?php
/**
 * Created by PhpStorm.
 * User: imamsantosa
 * Date: 5/28/16
 * Time: 00:02
 */

namespace App\Http\Controllers\UserApi;


use App\Repositories\UserApi\ReportRepository;

class ReportController extends BaseController
{
    private $repo;
    public function __construct(ReportRepository $repo)
    {
        $this->repo = $repo;
    }

    public function send()
    {
        return $this->respond($this->repo->send());
    }
}