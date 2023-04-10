<?php

namespace App\Http\Controllers\Genie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Log;
class DatabaseBackup extends Controller
{
    public function index()
    {
      
      //wp_batches_details start
      Log::info('wp_batches_details start');
      $batchdata= DB::connection('mysql6')->table(wp_batches_details)->get();
      foreach($batchdata as $batches){
          $id=$batches->id;
          $localbatchdata=DB::connection('mysql2')->table(wp_batches_details)->where('id',$id)->get()->toArray();
          //dd($localbatchdata);
          if(!empty($localbatchdata)){
              
              $updateAry=[
                "batch_name"                =>$batches->batch_name,
                "batch_course"              =>$batches->batch_course,
                "batch_created_on"          =>$batches->batch_created_on,
                "batch_starts_on"           =>$batches->batch_starts_on,
                "batch_end_on"              =>$batches->batch_end_on,
                "batch_month_year"          =>$batches->batch_month_year,
                "occurrence"                =>$batches->occurrence,
                "batch_starts_desc"         =>$batches->batch_starts_desc,
                "batch_last_updated"        =>$batches->batch_last_updated,
                "batch_visibility"          =>$batches->batch_visibility,
                "batch_visibilitytrainer"   =>$batches->batch_visibilitytrainer,    
                "batch_creator"             =>$batches->batch_creator,
                "batch_trainer"             =>$batches->batch_trainer,
                "attendancebatch"           =>$batches->attendancebatch,
                "firstdate_attendance"      =>$batches->firstdate_attendance,
                "batch_attance_status"      =>$batches->batch_attance_status,
                "attenddatebatch"           =>$batches->attenddatebatch,
                "batch_feedback"            =>$batches->batch_feedback,
                "batch_feedback_createby"   =>$batches->batch_feedback_createby,
                "status"                    =>$batches->status,
                "invoice_status"            =>$batches->invoice_status,
                "invoice_share50"           =>$batches->invoice_share50,
                "invoice_second50"          =>$batches->invoice_second50,
                "invoice_share100"          =>$batches->invoice_share100,
                "batch_course_status"       =>$batches->batch_course_status,
                "finished_date"             =>$batches->finished_date,
                "meetingurl"                =>$batches->meetingurl,
                "deleted_by"                =>$batches->deleted_by,
                "deleted_at"                =>$batches->deleted_at,
                "created_at"                =>$batches->created_at,
                "updated_at"                =>$batches->updated_at
              ];
              Log::info('data update start');
              $batchUpdate=DB::connection('mysql2')->table(wp_batches_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              
              $insertAry=[
                "batch_name"                =>$batches->batch_name,
                "batch_course"              =>$batches->batch_course,
                "batch_created_on"          =>$batches->batch_created_on,
                "batch_starts_on"           =>$batches->batch_starts_on,
                "batch_end_on"              =>$batches->batch_end_on,
                "batch_month_year"          =>$batches->batch_month_year,
                "occurrence"                =>$batches->occurrence,
                "batch_starts_desc"         =>$batches->batch_starts_desc,
                "batch_last_updated"        =>$batches->batch_last_updated,
                "batch_visibility"          =>$batches->batch_visibility,
                "batch_visibilitytrainer"   =>$batches->batch_visibilitytrainer,    
                "batch_creator"             =>$batches->batch_creator,
                "batch_trainer"             =>$batches->batch_trainer,
                "attendancebatch"           =>$batches->attendancebatch,
                "firstdate_attendance"      =>$batches->firstdate_attendance,
                "batch_attance_status"      =>$batches->batch_attance_status,
                "attenddatebatch"           =>$batches->attenddatebatch,
                "batch_feedback"            =>$batches->batch_feedback,
                "batch_feedback_createby"   =>$batches->batch_feedback_createby,
                "status"                    =>$batches->status,
                "invoice_status"            =>$batches->invoice_status,
                "invoice_share50"           =>$batches->invoice_share50,
                "invoice_second50"          =>$batches->invoice_second50,
                "invoice_share100"          =>$batches->invoice_share100,
                "batch_course_status"       =>$batches->batch_course_status,
                "finished_date"             =>$batches->finished_date,
                "meetingurl"                =>$batches->meetingurl,
                "deleted_by"                =>$batches->deleted_by,
                "deleted_at"                =>$batches->deleted_at,
                "created_at"                =>$batches->created_at,
                "updated_at"                =>$batches->updated_at
              ];
              Log::info('data insert start');
              $batchInsert=DB::connection('mysql2')->table(wp_batches_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      //wp_batches_details end
      Log::info('wp_batches_details end');
      
      
      dd('suceee');
      
      
      
      
      
      
      //wp_batch_attendance start
      Log::info('wp_batch_attendance start');
      $batch_attendance_data= DB::connection('mysql6')->table(wp_batch_attendance)->get();
      foreach($batch_attendance_data as $data){
          $id=$data->id;
          $localbatch_attendance_data=DB::connection('mysql2')->table(wp_batch_attendance)->where('id',$id)->get()->toArray();
          if(!empty($localbatch_attendance_data)){
              $updateAry=[
                "trainer_id"                =>$data->trainer_id,
                "batch_id"                  =>$data->batch_id,
                "attendate"                 =>$data->attendate,
                "created_at"                =>$data->created_at,
                "updated_at"                =>$data->updated_at
              ];
              Log::info('data update start');
              $batchUpdate=DB::connection('mysql2')->table(wp_batch_attendance)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "trainer_id"                =>$data->trainer_id,
                "batch_id"                  =>$data->batch_id,
                "attendate"                 =>$data->attendate,
                "created_at"                =>$data->created_at,
                "updated_at"                =>$data->updated_at
              ];
              Log::info('data insert start');
              $batchInsert=DB::connection('mysql2')->table(wp_batch_attendance)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_batch_attendance end');
      //wp_batch_attendance end
      
      
      
      
      
      
      
      
      
      //wp_courses_details start
      Log::info('wp_courses_details start');
      $courses_details_data= DB::connection('mysql6')->table(wp_courses_details)->get();
      foreach($courses_details_data as $data){
          $id=$data->id;
          $localcourses_details_data=DB::connection('mysql2')->table(wp_courses_details)->where('id',$id)->get()->toArray();
          if(!empty($localcourses_details_data)){
              $updateAry=[
                "course"                =>$data->course,
                "course_abbr"           =>$data->course_abbr,
                "sub_courses"           =>$data->sub_courses,
                "trainers"              =>$data->trainers,
                "course_fees"           =>$data->course_fees
              ];
              Log::info('data update start');
              $courses_detailsUpdate=DB::connection('mysql2')->table(wp_courses_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "course"                =>$data->course,
                "course_abbr"           =>$data->course_abbr,
                "sub_courses"           =>$data->sub_courses,
                "trainers"              =>$data->trainers,
                "course_fees"           =>$data->course_fees
              ];
              Log::info('data insert start');
              $courses_detailsInsert=DB::connection('mysql2')->table(wp_courses_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_courses_details end');
      //wp_courses_details end
      
      
      
      
      
      //wp_fees_details start
      Log::info('wp_fees_details start');
      $fees_details_data= DB::connection('mysql6')->table(wp_fees_details)->get();
      foreach($fees_details_data as $data){
          $id=$data->id;
          $localfees_details_data=DB::connection('mysql2')->table(wp_fees_details)->where('id',$id)->get()->toArray();
          if(!empty($localfees_details_data)){
              $updateAry=[
                "fees_invoice"          =>$data->fees_invoice,
                "s_id"                  =>$data->s_id,
                "due_date"              =>$data->due_date,
                "due_amt"               =>$data->due_amt,
                "paid_on"               =>$data->paid_on,
                "paid_amt"              =>$data->paid_amt,
                "paid_amt_in_words"     =>$data->paid_amt_in_words,
                "service_tax"           =>$data->service_tax,
                "payment_mode"          =>$data->payment_mode,
                "payment_bank"          =>$data->payment_bank,
                "source"                =>$data->source,
                "chq_card_no"           =>$data->chq_card_no,
                "balance"               =>$data->balance,
                "fammount"              =>$data->fammount,
                "collector_id"          =>$data->collector_id,
                "remark"                =>$data->remark
              ];
              Log::info('data update start');
              $fees_details_dataUpdate=DB::connection('mysql2')->table(wp_fees_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "fees_invoice"          =>$data->fees_invoice,
                "s_id"                  =>$data->s_id,
                "due_date"              =>$data->due_date,
                "due_amt"               =>$data->due_amt,
                "paid_on"               =>$data->paid_on,
                "paid_amt"              =>$data->paid_amt,
                "paid_amt_in_words"     =>$data->paid_amt_in_words,
                "service_tax"           =>$data->service_tax,
                "payment_mode"          =>$data->payment_mode,
                "payment_bank"          =>$data->payment_bank,
                "source"                =>$data->source,
                "chq_card_no"           =>$data->chq_card_no,
                "balance"               =>$data->balance,
                "fammount"              =>$data->fammount,
                "collector_id"          =>$data->collector_id,
                "remark"                =>$data->remark
              ];
              Log::info('data insert start');
              $fees_details_dataInsert=DB::connection('mysql2')->table(wp_fees_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_fees_details end');
      //wp_fees_details end
      
      
      
      
      
      
      
      
      
      
      //wp_generate_invoice start
      Log::info('wp_generate_invoice start');
      $generate_invoice_data= DB::connection('mysql6')->table(wp_generate_invoice)->get();
      foreach($generate_invoice_data as $data){
          $id=$data->id;
          $localgenerate_invoice_data=DB::connection('mysql2')->table(wp_generate_invoice)->where('id',$id)->get()->toArray();
          if(!empty($localgenerate_invoice_data)){
              $updateAry=[
                "trainer_pay_id"          =>$data->trainer_pay_id,
                "amount"                  =>$data->amount,
                "balance"                 =>$data->balance,
                "pay_amount"              =>$data->pay_amount,
                "temp_advance"            =>$data->temp_advance,
                "pay_mode"                =>$data->pay_mode,
                "technology"              =>$data->technology,
                "docs"                    =>$data->docs,
                "dash_remark"             =>$data->dash_remark,
                "pay_status"              =>$data->pay_status,
                "generate_status"         =>$data->generate_status,
                "approval_status"         =>$data->approval_status,
                "feedinvoice_approve"     =>$data->feedinvoice_approve,
                "batch_status"            =>$data->batch_status,
                "pay_hold"                =>$data->pay_hold,
                "privacy_active"          =>$data->privacy_active,
                "approved_date"           =>$data->approved_date,
                "lms_status"              =>$data->lms_status,
                "invoice50"               =>$data->invoice50,
                "invoicesecond50"         =>$data->invoicesecond50,
                "invoice100"              =>$data->invoice100,
                "invoice_date"            =>$data->invoice_date,
                "paid_date"               =>$data->paid_date,
                "batch_id"                =>$data->batch_id,
                "studgroupid"             =>$data->studgroupid,
                "share"                   =>$data->share,
                "releases"                =>$data->releases,
                "enet_type"               =>$data->enet_type,
                "created_date"            =>$data->created_date,
                "created_at"              =>$data->created_at,
                "updated_at"              =>$data->updated_at
              ];
              Log::info('data update start');
              $generate_invoice_dataUpdate=DB::connection('mysql2')->table(wp_generate_invoice)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "trainer_pay_id"          =>$data->trainer_pay_id,
                "amount"                  =>$data->amount,
                "balance"                 =>$data->balance,
                "pay_amount"              =>$data->pay_amount,
                "temp_advance"            =>$data->temp_advance,
                "pay_mode"                =>$data->pay_mode,
                "technology"              =>$data->technology,
                "docs"                    =>$data->docs,
                "dash_remark"             =>$data->dash_remark,
                "pay_status"              =>$data->pay_status,
                "generate_status"         =>$data->generate_status,
                "approval_status"         =>$data->approval_status,
                "feedinvoice_approve"     =>$data->feedinvoice_approve,
                "batch_status"            =>$data->batch_status,
                "pay_hold"                =>$data->pay_hold,
                "privacy_active"          =>$data->privacy_active,
                "approved_date"           =>$data->approved_date,
                "lms_status"              =>$data->lms_status,
                "invoice50"               =>$data->invoice50,
                "invoicesecond50"         =>$data->invoicesecond50,
                "invoice100"              =>$data->invoice100,
                "invoice_date"            =>$data->invoice_date,
                "paid_date"               =>$data->paid_date,
                "batch_id"                =>$data->batch_id,
                "studgroupid"             =>$data->studgroupid,
                "share"                   =>$data->share,
                "releases"                =>$data->releases,
                "enet_type"               =>$data->enet_type,
                "created_date"            =>$data->created_date,
                "created_at"              =>$data->created_at,
                "updated_at"              =>$data->updated_at
              ];
              Log::info('data insert start');
              $generate_invoice_dataInsert=DB::connection('mysql2')->table(wp_generate_invoice)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_generate_invoice end');
      //wp_generate_invoice end
      
      
      
      
      
      
      
      
      
      
      
      //wp_allpayinvoice_details start
      Log::info('wp_allpayinvoice_details start');
      $allpayinvoice_details_data= DB::connection('mysql6')->table(wp_allpayinvoice_details)->get();
      foreach($allpayinvoice_details_data as $data){
          $id=$data->id;
          $localallpayinvoice_details_data=DB::connection('mysql2')->table(wp_allpayinvoice_details)->where('id',$id)->get()->toArray();
          if(!empty($localallpayinvoice_details_data)){
              $updateAry=[
                "invoice_id"          =>$data->invoice_id,
                "trainer_id"          =>$data->trainer_id,
                "collector_id"        =>$data->collector_id,
                "pay_amount"          =>$data->pay_amount,
                "pay_mode"            =>$data->pay_mode,
                "amount_type"         =>$data->amount_type,
                "source"              =>$data->source,
                "remarks"             =>$data->remarks,
                "created_at"          =>$data->created_at
              ];
              Log::info('data update start');
              $allpayinvoice_details_dataUpdate=DB::connection('mysql2')->table(wp_allpayinvoice_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "invoice_id"          =>$data->invoice_id,
                "trainer_id"          =>$data->trainer_id,
                "collector_id"        =>$data->collector_id,
                "pay_amount"          =>$data->pay_amount,
                "pay_mode"            =>$data->pay_mode,
                "amount_type"         =>$data->amount_type,
                "source"              =>$data->source,
                "remarks"             =>$data->remarks,
                "created_at"          =>$data->created_at
              ];
              Log::info('data insert start');
              $allpayinvoice_details_dataInsert=DB::connection('mysql2')->table(wp_allpayinvoice_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_allpayinvoice_details end');
      //wp_allpayinvoice_details end
      
      
      
      
      
      
      
      
      
      
      //wp_addpaytrainers_details start
      Log::info('wp_addpaytrainers_details start');
      $addpaytrainers_details_data= DB::connection('mysql6')->table(wp_addpaytrainers_details)->get();
      foreach($addpaytrainers_details_data as $data){
          $id=$data->id;
          $localaddpaytrainers_details_data=DB::connection('mysql2')->table(wp_addpaytrainers_details)->where('id',$id)->get()->toArray();
          if(!empty($localaddpaytrainers_details_data)){
              $updateAry=[
                "trainer_id"            =>$data->trainer_id,
                "trainer_name"          =>$data->trainer_name,
                "trainer_mobile"        =>$data->trainer_mobile,
                "trainer_email"         =>$data->trainer_email,
                "trainer_type"          =>$data->trainer_type,
                "deduction"             =>$data->deduction,
                "emp_code"              =>$data->emp_code,
                "department"            =>$data->department,
                "designation"           =>$data->designation,
                "dateofjoining"         =>$data->dateofjoining,
                "bankac"                =>$data->bankac,
                "advance_amount"        =>$data->advance_amount,
                "pre_advance_amount"    =>$data->pre_advance_amount,
                "pre_month_amt"         =>$data->pre_month_amt,
                "status"                =>$data->status,
                "created_date"          =>$data->created_date,
                "updated_date"          =>$data->updated_date
              ];
              Log::info('data update start');
              $addpaytrainers_details_dataUpdate=DB::connection('mysql2')->table(wp_addpaytrainers_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "trainer_id"            =>$data->trainer_id,
                "trainer_name"          =>$data->trainer_name,
                "trainer_mobile"        =>$data->trainer_mobile,
                "trainer_email"         =>$data->trainer_email,
                "trainer_type"          =>$data->trainer_type,
                "deduction"             =>$data->deduction,
                "emp_code"              =>$data->emp_code,
                "department"            =>$data->department,
                "designation"           =>$data->designation,
                "dateofjoining"         =>$data->dateofjoining,
                "bankac"                =>$data->bankac,
                "advance_amount"        =>$data->advance_amount,
                "pre_advance_amount"    =>$data->pre_advance_amount,
                "pre_month_amt"         =>$data->pre_month_amt,
                "status"                =>$data->status,
                "created_date"          =>$data->created_date,
                "updated_date"          =>$data->updated_date
              ];
              Log::info('data insert start');
              $addpaytrainers_details_dataInsert=DB::connection('mysql2')->table(wp_addpaytrainers_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_addpaytrainers_details end');
      //wp_addpaytrainers_details end
      
      
      
      
      
      
      
      
      
      
      
      //wp_students_details start
      Log::info('wp_students_details start');
      $students_details_data= DB::connection('mysql6')->table(wp_students_details)->get();
      foreach($students_details_data as $data){
          $id=$data->id;
          $localstudents_details_data=DB::connection('mysql2')->table(wp_students_details)->where('id',$id)->get()->toArray();
          if(!empty($localstudents_details_data)){
              $updateAry=[
                "stud_id"               =>$data->stud_id,
                "stud_batch_id"         =>$data->stud_batch_id,
                "duplicate"             =>$data->duplicate,
                "name"                  =>$data->name,
                "code"                  =>$data->code,
                "phone"                 =>$data->phone,
                "whatsapp_no"           =>$data->whatsapp_no,
                "email"                 =>$data->email,
                "role"                  =>$data->role,
                "category"              =>$data->category,
                "course"                =>$data->course,
                "pic_image"             =>$data->pic_image,
                "batch_time_day"        =>$data->batch_time_day,
                "batch_date_time"       =>$data->batch_date_time,
                "expected_joining_date" =>$data->expected_joining_date,
                "std_comp_name"         =>$data->std_comp_name,
                "type"                  =>$data->type,
                "salary"                =>$data->salary,
                "refered_by"            =>$data->refered_by,
                "courses"               =>$data->courses,
                "sub_courses"           =>$data->sub_courses,
                "trainer"               =>$data->trainer,
                "total_fees"            =>$data->total_fees,
                "discount"              =>$data->discount,
                "fees_adjust"           =>$data->fees_adjust,
                "to_be_paid"            =>$data->to_be_paid,
                "stud_decided_fees"     =>$data->stud_decided_fees,
                "gst_status"            =>$data->gst_status,
                "total_gst"             =>$data->total_gst,
                "regist_fees_gst"       =>$data->regist_fees_gst,
                "otp"                   =>$data->otp,
                "payanyway"             =>$data->payanyway,
                "reason"                =>$data->reason,
                "collector_id"          =>$data->collector_id,
                "registration_charges"  =>$data->registration_charges,
                "mode_of_payment"       =>$data->mode_of_payment,
                "next_due_date"         =>$data->next_due_date,
                "next_due_amt"          =>$data->next_due_amt,
                "new_due_date"          =>$data->new_due_date,
                "reminder_date"         =>$data->reminder_date,
                "reminder_status"       =>$data->reminder_status,
                "no_of_inst"            =>$data->no_of_inst,
                "student_registered"    =>$data->student_registered,
                "status"                =>$data->status,
                "fees_status"           =>$data->fees_status,
                "fees_verified"         =>$data->fees_verified,
                "expected_status"       =>$data->expected_status,
                "batch_start_status"    =>$data->batch_start_status,
                "trainer_invoice"       =>$data->trainer_invoice,
                "trainer_incentive"     =>$data->trainer_incentive,
                "trainer_incentive_second_50"   =>$data->trainer_incentive_second_50,
                "trainer_incentive_100"         =>$data->trainer_incentive_100,
                "employee_incentive"            =>$data->employee_incentive,
                "refund_amount"                 =>$data->refund_amount,
                "refund_date"                   =>$data->refund_date,
                "refund"                =>$data->refund,
                "deleted"               =>$data->deleted,
                "drop_status"           =>$data->drop_status,
                "deleted_by"            =>$data->deleted_by,
                "deleted_on"            =>$data->deleted_on,
                "came_by"               =>$data->came_by,
                "counsellor"            =>$data->counsellor,
                "share_counsellor"      =>$data->share_counsellor,
                "share_percentage"      =>$data->share_percentage,
                "comments"              =>$data->comments,
                "dash_remark"           =>$data->dash_remark,
                "first_remark"          =>$data->first_remark,
                "second_remark"         =>$data->second_remark,
                "feedback"              =>$data->feedback,
                "feedback_status"       =>$data->feedback_status,
                "first_feed"            =>$data->first_feed,
                "second_feed"           =>$data->second_feed,
                "third_feed"            =>$data->third_feed,
                "FB_1"                  =>$data->FB_1,
                "FB_2"                  =>$data->FB_2,
                "FB_3"                  =>$data->FB_3,
                "rating"                =>$data->rating,
                "attendancecount"       =>$data->attendancecount,
                "std_attance_status"    =>$data->std_attance_status,
                "std_first_remark"      =>$data->std_first_remark,
                "std_second_remark"     =>$data->std_second_remark,
                "std_third_remark"      =>$data->std_third_remark,
                "attenddate"            =>$data->attenddate,
                "verifycourse"          =>$data->verifycourse,
                "verifyfees"            =>$data->verifyfees,
                "verifyamount"          =>$data->verifyamount,
                "mode"                  =>$data->mode,
                "verifycounellor"       =>$data->verifycounellor,
                "verifytrainer"         =>$data->verifytrainer,
                "verifyduedate"         =>$data->verifyduedate,
                "slot"                  =>$data->slot,
                "fammount"              =>$data->fammount,
                "created_at"            =>$data->created_at,
                "updated_at"            =>$data->updated_at
              ];
              Log::info('data update start');
              $students_details_dataUpdate=DB::connection('mysql2')->table(wp_students_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "stud_id"               =>$data->stud_id,
                "stud_batch_id"         =>$data->stud_batch_id,
                "duplicate"             =>$data->duplicate,
                "name"                  =>$data->name,
                "code"                  =>$data->code,
                "phone"                 =>$data->phone,
                "whatsapp_no"           =>$data->whatsapp_no,
                "email"                 =>$data->email,
                "role"                  =>$data->role,
                "category"              =>$data->category,
                "course"                =>$data->course,
                "pic_image"             =>$data->pic_image,
                "batch_time_day"        =>$data->batch_time_day,
                "batch_date_time"       =>$data->batch_date_time,
                "expected_joining_date" =>$data->expected_joining_date,
                "std_comp_name"         =>$data->std_comp_name,
                "type"                  =>$data->type,
                "salary"                =>$data->salary,
                "refered_by"            =>$data->refered_by,
                "courses"               =>$data->courses,
                "sub_courses"           =>$data->sub_courses,
                "trainer"               =>$data->trainer,
                "total_fees"            =>$data->total_fees,
                "discount"              =>$data->discount,
                "fees_adjust"           =>$data->fees_adjust,
                "to_be_paid"            =>$data->to_be_paid,
                "stud_decided_fees"     =>$data->stud_decided_fees,
                "gst_status"            =>$data->gst_status,
                "total_gst"             =>$data->total_gst,
                "regist_fees_gst"       =>$data->regist_fees_gst,
                "otp"                   =>$data->otp,
                "payanyway"             =>$data->payanyway,
                "reason"                =>$data->reason,
                "collector_id"          =>$data->collector_id,
                "registration_charges"  =>$data->registration_charges,
                "mode_of_payment"       =>$data->mode_of_payment,
                "next_due_date"         =>$data->next_due_date,
                "next_due_amt"          =>$data->next_due_amt,
                "new_due_date"          =>$data->new_due_date,
                "reminder_date"         =>$data->reminder_date,
                "reminder_status"       =>$data->reminder_status,
                "no_of_inst"            =>$data->no_of_inst,
                "student_registered"    =>$data->student_registered,
                "status"                =>$data->status,
                "fees_status"           =>$data->fees_status,
                "fees_verified"         =>$data->fees_verified,
                "expected_status"       =>$data->expected_status,
                "batch_start_status"    =>$data->batch_start_status,
                "trainer_invoice"       =>$data->trainer_invoice,
                "trainer_incentive"     =>$data->trainer_incentive,
                "trainer_incentive_second_50"   =>$data->trainer_incentive_second_50,
                "trainer_incentive_100"         =>$data->trainer_incentive_100,
                "employee_incentive"            =>$data->employee_incentive,
                "refund_amount"                 =>$data->refund_amount,
                "refund_date"                   =>$data->refund_date,
                "refund"                =>$data->refund,
                "deleted"               =>$data->deleted,
                "drop_status"           =>$data->drop_status,
                "deleted_by"            =>$data->deleted_by,
                "deleted_on"            =>$data->deleted_on,
                "came_by"               =>$data->came_by,
                "counsellor"            =>$data->counsellor,
                "share_counsellor"      =>$data->share_counsellor,
                "share_percentage"      =>$data->share_percentage,
                "comments"              =>$data->comments,
                "dash_remark"           =>$data->dash_remark,
                "first_remark"          =>$data->first_remark,
                "second_remark"         =>$data->second_remark,
                "feedback"              =>$data->feedback,
                "feedback_status"       =>$data->feedback_status,
                "first_feed"            =>$data->first_feed,
                "second_feed"           =>$data->second_feed,
                "third_feed"            =>$data->third_feed,
                "FB_1"                  =>$data->FB_1,
                "FB_2"                  =>$data->FB_2,
                "FB_3"                  =>$data->FB_3,
                "rating"                =>$data->rating,
                "attendancecount"       =>$data->attendancecount,
                "std_attance_status"    =>$data->std_attance_status,
                "std_first_remark"      =>$data->std_first_remark,
                "std_second_remark"     =>$data->std_second_remark,
                "std_third_remark"      =>$data->std_third_remark,
                "attenddate"            =>$data->attenddate,
                "verifycourse"          =>$data->verifycourse,
                "verifyfees"            =>$data->verifyfees,
                "verifyamount"          =>$data->verifyamount,
                "mode"                  =>$data->mode,
                "verifycounellor"       =>$data->verifycounellor,
                "verifytrainer"         =>$data->verifytrainer,
                "verifyduedate"         =>$data->verifyduedate,
                "slot"                  =>$data->slot,
                "fammount"              =>$data->fammount,
                "created_at"            =>$data->created_at,
                "updated_at"            =>$data->updated_at
              ];
              Log::info('data insert start');
              $students_details_dataInsert=DB::connection('mysql2')->table(wp_students_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_students_details end');
      //wp_students_details end
      
      
      
      
      
      
      
      
      
      //wp_students_attendance start
      Log::info('wp_students_attendance start');
      $students_attendance_data= DB::connection('mysql6')->table(wp_students_attendance)->get();
      foreach($students_attendance_data as $data){
          $id=$data->id;
          $localstudents_attendance_data=DB::connection('mysql2')->table(wp_students_attendance)->where('id',$id)->get()->toArray();
          if(!empty($localstudents_attendance_data)){
              $updateAry=[
                "students_id"       =>$data->students_id,
                "attendate"         =>$data->attendate,
                "created_at"        =>$data->created_at,
                "updated_at"        =>$data->updated_at
              ];
              Log::info('data update start');
              $students_attendance_dataUpdate=DB::connection('mysql2')->table(wp_students_attendance)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "students_id"       =>$data->students_id,
                "attendate"         =>$data->attendate,
                "created_at"        =>$data->created_at,
                "updated_at"        =>$data->updated_at
              ];
              Log::info('data insert start');
              $students_attendance_dataInsert=DB::connection('mysql2')->table(wp_students_attendance)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_students_attendance end');
      //wp_students_attendance end
      
      
      
      
      
      
      
      
       //wp_trainers_details start
      Log::info('wp_trainers_details start');
      $trainers_details_data= DB::connection('mysql6')->table(wp_trainers_details)->get();
      foreach($trainers_details_data as $data){
          $id=$data->id;
          $localtrainers_details_data=DB::connection('mysql2')->table(wp_trainers_details)->where('id',$id)->get()->toArray();
          if(!empty($localtrainers_details_data)){
              $updateAry=[
                "name"                  =>$data->name,
                "trainer_phone"         =>$data->trainer_phone,
                "trainer_email"         =>$data->trainer_email,
                "courses"               =>$data->courses,
                "trainer_id"            =>$data->trainer_id,
                "status"                =>$data->status,
                "type"                  =>$data->type,
                "role"                  =>$data->role,
                "pic_image"             =>$data->pic_image,
                "payout_share"          =>$data->payout_share,
                "fix_share"             =>$data->fix_share,
                "FL_Share1"             =>$data->FL_Share1,
                "FL_Share2"             =>$data->FL_Share2,
                "FL_Share3"             =>$data->FL_Share3,
                "per_student"           =>$data->per_student,
                "first_per_student"     =>$data->first_per_student,
                "second_per_student"    =>$data->second_per_student,
                "share_release"         =>$data->share_release,
                "trainer_address"       =>$data->trainer_address,
                "trainer_Aadhar"        =>$data->trainer_Aadhar,
                "trainer_pan"           =>$data->trainer_pan,
                "trainer_description"   =>$data->trainer_description,
                "trainer_tc"            =>$data->trainer_tc,
                "trainer_agreement"     =>$data->trainer_agreement,
                "agreement_file"        =>$data->agreement_file,
                "account_verified"      =>$data->account_verified,
                "temp_googleno"         =>$data->temp_googleno,
                "temp_phoneno"          =>$data->temp_phoneno,
                "temp_paytm"            =>$data->temp_paytm,
                "temp_amazonPay"        =>$data->temp_amazonPay,
                "temp_bankdetails"      =>$data->temp_bankdetails,
                "account_type"          =>$data->account_type,
                "bank_name"             =>$data->bank_name,
                "branch_name"           =>$data->branch_name,
                "account_holder"        =>$data->account_holder,
                "accountno"             =>$data->accountno,
                "IFSC"                  =>$data->IFSC,
                "meetingurl"            =>$data->meetingurl,
                "comments"              =>$data->comments,
                "deleted_date"          =>$data->deleted_date,
                "created_at"            =>$data->created_at,
                "updated_at"            =>$data->updated_at
              ];
              Log::info('data update start');
              $trainers_details_dataUpdate=DB::connection('mysql2')->table(wp_trainers_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "name"                  =>$data->name,
                "trainer_phone"         =>$data->trainer_phone,
                "trainer_email"         =>$data->trainer_email,
                "courses"               =>$data->courses,
                "trainer_id"            =>$data->trainer_id,
                "status"                =>$data->status,
                "type"                  =>$data->type,
                "role"                  =>$data->role,
                "pic_image"             =>$data->pic_image,
                "payout_share"          =>$data->payout_share,
                "fix_share"             =>$data->fix_share,
                "FL_Share1"             =>$data->FL_Share1,
                "FL_Share2"             =>$data->FL_Share2,
                "FL_Share3"             =>$data->FL_Share3,
                "per_student"           =>$data->per_student,
                "first_per_student"     =>$data->first_per_student,
                "second_per_student"    =>$data->second_per_student,
                "share_release"         =>$data->share_release,
                "trainer_address"       =>$data->trainer_address,
                "trainer_Aadhar"        =>$data->trainer_Aadhar,
                "trainer_pan"           =>$data->trainer_pan,
                "trainer_description"   =>$data->trainer_description,
                "trainer_tc"            =>$data->trainer_tc,
                "trainer_agreement"     =>$data->trainer_agreement,
                "agreement_file"        =>$data->agreement_file,
                "account_verified"      =>$data->account_verified,
                "temp_googleno"         =>$data->temp_googleno,
                "temp_phoneno"          =>$data->temp_phoneno,
                "temp_paytm"            =>$data->temp_paytm,
                "temp_amazonPay"        =>$data->temp_amazonPay,
                "temp_bankdetails"      =>$data->temp_bankdetails,
                "account_type"          =>$data->account_type,
                "bank_name"             =>$data->bank_name,
                "branch_name"           =>$data->branch_name,
                "account_holder"        =>$data->account_holder,
                "accountno"             =>$data->accountno,
                "IFSC"                  =>$data->IFSC,
                "meetingurl"            =>$data->meetingurl,
                "comments"              =>$data->comments,
                "deleted_date"          =>$data->deleted_date,
                "created_at"            =>$data->created_at,
                "updated_at"            =>$data->updated_at
              ];
              Log::info('data insert start');
              $trainers_details_dataInsert=DB::connection('mysql2')->table(wp_trainers_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_trainers_details end');
      //wp_trainers_details end
      
      
      
      
      
      
      
      
      //wp_users start
      Log::info('wp_users start');
      $users_data= DB::connection('mysql6')->table(wp_users)->get();
      foreach($users_data as $data){
          $id=$data->id;
          $localusers_data=DB::connection('mysql2')->table(wp_users)->where('id',$id)->get()->toArray();
          if(!empty($localusers_data)){
              $updateAry=[
                "user_login"            =>$data->user_login,
                "user_pass"             =>$data->user_pass,
                "user_nicename"         =>$data->user_nicename,
                "user_email"            =>$data->user_email,
                "user_url"              =>$data->user_url,
                "user_registered"       =>$data->user_registered,
                "user_activation_key"   =>$data->user_activation_key,
                "user_status"           =>$data->user_status,
                "display_name"          =>$data->display_name
              ];
              Log::info('data update start');
              $users_dataUpdate=DB::connection('mysql2')->table(wp_users)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "user_login"            =>$data->user_login,
                "user_pass"             =>$data->user_pass,
                "user_nicename"         =>$data->user_nicename,
                "user_email"            =>$data->user_email,
                "user_url"              =>$data->user_url,
                "user_registered"       =>$data->user_registered,
                "user_activation_key"   =>$data->user_activation_key,
                "user_status"           =>$data->user_status,
                "display_name"          =>$data->display_name
              ];
              Log::info('data insert start');
              $users_dataInsert=DB::connection('mysql2')->table(wp_users)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_users end');
      //wp_users end
      
      
      
      
      
      
      
      
      
      //wp_modes_details start
      Log::info('wp_modes_details start');
      $modes_details_data= DB::connection('mysql6')->table(wp_modes_details)->get();
      foreach($modes_details_data as $data){
          $id=$data->id;
          $localmodes_details_data=DB::connection('mysql2')->table(wp_modes_details)->where('id',$id)->get()->toArray();
          if(!empty($localmodes_details_data)){
              $updateAry=[
                "mode"          =>$data->mode,
                "status"        =>$data->status,
                "slug"          =>$data->slug
              ];
              Log::info('data update start');
              $modes_details_dataUpdate=DB::connection('mysql2')->table(wp_modes_details)->where('id',$id)->update($updateAry);
              Log::info('data update end');
          }
          else{
              $insertAry=[
                "mode"          =>$data->mode,
                "status"        =>$data->status,
                "slug"          =>$data->slug
              ];
              Log::info('data insert start');
              $modes_details_dataInsert=DB::connection('mysql2')->table(wp_modes_details)->insert($insertAry);
              Log::info('data insert start');
          }
      }
      Log::info('wp_modes_details end');
      //wp_modes_details end
      
      

      
      
      
      
      
    
    }
}
