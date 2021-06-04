<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GostFilter
 *
 * @author Marko
 */
class KorisnikFilter implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session=session();
        
        if($session->has('moderator'))
            return redirect()->to(base_url('Moderator'));
        if($session->has('administrator'))
            return redirect()->to(base_url('Administrator'));
        if(!$session->has('korisnik'))
            return redirect()->to(base_url('Gost'));
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
