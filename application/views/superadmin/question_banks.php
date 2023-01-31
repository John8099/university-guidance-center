<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex">
          <div class="ms-auto">
            <a href="<?= site_url() . 'superadmin/question_bank'; ?>" type="button" class="btn btn-outline-success btn-sm" title="Create Question">Create Question</a>
          </div>
        </div>
        <?php if ($this->session->flashdata('question_bank_save_result') !== null) : ?>
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
          </svg>
          <div class="alert alert-danger d-flex align-items-center" role="alert" id="alertprimary">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
              <use xlink:href="#info-fill" />
            </svg>
            <div>
              <?= $this->session->flashdata('question_bank_save_result'); ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="table-responsive">
          <table id="datatable" class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Question</th>
                <th scope="col">Type</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Created By</th>
                <th style="width: 10%;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = $this->db->query("SELECT * FROM tblquestionbank WHERE Status!=2;");

              foreach ($query->result() as $row) :

              ?>
                <tr>
                  <td><?= $row->Question; ?></td>
                  <td><?= $row->Category; ?></td>
                  <td><?= date('Y-m-d', strtotime($row->CreatedOn)); ?></td>
                  <td><?= ($row->Status == 0 ? 'Disable' : 'Enable'); ?></td>
                  <td><?= $this->routines->getUserFullName($row->CreatedBy); ?></td>
                  <td>
                    <?php if ($row->Status == 0) : ?>
                      <a href="<?= site_url() . 'superadmin/question_bank_update_status/' . $row->QuestionID . '/1'; ?>" class="btn btn-outline-warning btn-sm" title="Enable" style="width: 100px; margin: .25rem">Enable</a>
                    <?php else : ?>
                      <a href="<?= site_url() . 'superadmin/question_bank_update_status/' . $row->QuestionID . '/0'; ?>" class="btn btn-outline-warning btn-sm" title="Disable" style="width: 100px; margin: .25rem">Disable</a>
                    <?php endif; ?>
                    <a href="<?= site_url() . 'superadmin/question_bank/' . $row->QuestionID; ?>" class="btn btn-outline-primary btn-sm" title="Edit" style="width: 100px; margin: .25rem">Edit</a>
                    <a href="<?= site_url() . 'superadmin/question_bank_update_status/' . $row->QuestionID . '/2'; ?>" class="btn btn-outline-danger btn-sm" title="Delete" style="width: 100px; margin: .25rem">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div><!--.card-body-->
    </div>
  </div>
</div>