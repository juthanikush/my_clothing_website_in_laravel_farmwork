<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['data']=Tax::all();
        return view('admin.tax',$result);
    }

    
    public function manage_tax(Request $request ,$id=' ')
    {

        
        if($id>0){
           /* $model=coupon::find($id);
            $result['data']=$model;
            return view('admin.manage_coupon',$result);*/
            $arr=Tax::where(['id'=>$id])->get();

            $result['tax_desc']=$arr['0']->tax_desc;
            $result['tax_value']=$arr['0']->tax_value;
            $result['id']=$arr['0']->id;
        }else{
            $result['tax_desc']="";
            $result['tax_value']="";
            
            $result['id']=0;
        }
        return view('admin.manage_tax',$result);
    }

    public function manage_tax_process(Request $request)
    {//return $request->post();
       $request->validate([
            'tax_value'=>'required|unique:taxs,tax_value,'.$request->post('id'),
            
        ]);

        if($request->post('id')>0){
            $model =Tax::find($request->post('id'));
            $msg="Tax Update";
        }else{
            $model = new Tax();
            $msg="Tax Inserted";
        }
        $model->tax_desc=$request->post('tax_desc');
        $model->tax_value=$request->post('tax_value');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/tax');
    }

    public function delete(Request $request,$id)
    {
        $model=Tax::find($id);
        $model->delete();
        $request->session()->flash('message','Tax Delete');
        return redirect('admin/tax');
    }

    public function status(Request $request,$status ,$id)
    {
        $model=Tax::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Tax Status Update');
        return redirect('admin/tax');
    }
}
