<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require APPPATH . '/libraries/REST_Controller.php';

use restserver\libraries\REST_Controller;
 
class karyawan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data 
    function index_get() {
        $idkaryawan = $this->get('idkaryawan');
        if ($idkaryawan == '') {
            $karyawan = $this->db->get('karyawan')->result();
        } else {
            $this->db->where('idkaryawan', $idkaryawan);
            $karyawan = $this->db->get('karyawan')->result();
        }
        $this->response($karyawan, 200);
    }
 
    // insert new data 
    function index_post() {
        $data = array(
                    'idkaryawan'           => $this->post('idkaryawan'),
                    'nip'          => $this->post('nip'),
                    'nama'    => $this->post('nama'),
                    'password'        => $this->post('password'));
        $insert = $this->db->insert('karyawan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    function index_put() {
        $idkaryawan = $this->put('idkaryawan');
        $data = array(
                    'idkaryawan'           => $this->post('idkaryawan'),
                    'nip'          => $this->post('nip'),
                    'nama'    => $this->post('nama'),
                    'password'        => $this->post('password'));
        $this->db->where('idkaryawan', $idkaryawan);
        $update = $this->db->update('karyawan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete 
    function index_delete() {
        $idkaryawan = $this->delete('idkaryawan');
        $this->db->where('idkaryawan', $idkaryawan);
        $delete = $this->db->delete('karyawan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}
