<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\Request;


/* Models */

Use App\Models\CenterCost;
use App\Models\Employee;
use App\Models\IdentificationType;
use App\Models\Boss;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\Position;

/* Modulos  */

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {
        $notifications = DB::table('notifications as n')->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')->join('employees as em', 'n.employee_id','=','em.id')->join('positions as pos','n.position_id','=','pos.id')->join('center_costs as cc','n.center_cost_id','=','cc.id')->join('bosses as boss','n.boss_id','=','boss.id')->join('notifications_types as nt','n.notifications_type_id','=','nt.id')->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','pos.name as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad',DB::raw("CONCAT(LEFT((started_date),10),' ',TIME_FORMAT(RIGHT((started_date),8),'%r')) AS 'fecha_inicio' "),DB::raw("CONCAT(LEFT((finish_date),10),' ',TIME_FORMAT(RIGHT((finish_date),8),'%r')) AS 'fecha_final' "),'total_days as total de dias','total_hours as total de horas','observation as observacion')
        ->orderBy('fecha_inicio','asc')
        ->get();

       /*$notifications = DB::table('notifications as n')
                            ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
                            ->join('employees as em', 'n.employee_id','=','em.id')
                            ->join('positions as pos','n.position_id','=','pos.id')
                            ->join('center_costs as cc','n.center_cost_id','=','cc.id')
                            ->join('bosses as boss','n.boss_id','=','boss.id')
                            ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
                            ->select('n.id','idt.name as type_identification','em.identification as identificacion','em.first_name','em.last_name','pos.name as cargo','cc.name as center_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad',DB::raw("CONCAT(LEFT((started_date),10),' ',TIME_FORMAT(RIGHT((started_date),8),'%r')) AS 'fecha_inicio' "),DB::raw("CONCAT(LEFT((finish_date),10),' ',TIME_FORMAT(RIGHT((finish_date),8),'%r')) AS 'fecha_finalizacion' "),'total_days as total_dias','total_hours as total_horas','observation as observacion')
                            ->orderBy('n.id','ASC')
                            ->get(); */
        return view('notifications.index', compact('notifications'));
    }

  
    public function create(){

        $user = Auth::user();


        $center_costs = CenterCost::all()->pluck('name','id');
        $employees = Employee::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
        $types = IdentificationType::all()->pluck('name','id');
        $positions = Position::all()->pluck('name','id');
        $bosses = Boss::select('fullname','id')->orderBy('fullname','asc')->pluck('fullname','id');
        $notifications = NotificationType::select('name','id')->orderBy('name','asc')->pluck('name','id');

        return view('notifications.create', compact('center_costs','employees','types','positions','bosses','notifications','user'));
    }

    
    public function store(StoreNotificationRequest $request)
    {

        $request->validated();
        
        $notification = $request->all();
        $notification_object = (object)$notification;

        $fechaInicio = Carbon::parse($notification_object->started_date);
        $fechafinalizacion = Carbon::parse($notification_object->finish_date);
        $notification_object->total_days = $fechaInicio->diffInDays($fechafinalizacion);
        $notification_object->total_hours = $fechaInicio->floatDiffInHours($fechafinalizacion);

        $notification_array = (array)$notification_object;

        

       $notification = Notification::create($notification_array);
       return redirect()->route('notifications.show',compact('notification'));
        
    }


    public function show(Notification $notification)
    {
        
        $notification =  Notification::find($notification->id);
      
      
        return view('notifications.show',compact('notification'));
    }

  
    public function edit(Notification $notification)
    {
        
       $center_costs = CenterCost::all()->pluck('name','id');
        $employees = Employee::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
        $types = IdentificationType::all()->pluck('name','id');
        $positions = Position::all()->pluck('name','id');
        $bosses = Boss::select('fullname','id')->orderBy('fullname','asc')->pluck('fullname','id');
        $notifications = NotificationType::select('name','id')->orderBy('name','asc')->pluck('name','id');
        $notification = Notification::find($notification->id);
        $notification->started_date = Carbon::parse($notification->started_date);
        $notification->finish_date = Carbon::parse($notification->finish_date);

         return view('notifications.edit',compact('center_costs','employees','types','positions','bosses','notifications','notification'));
    }

    public function update(Request $request,Notification $notification)
    {
        
        $notification =  Notification::find($notification->id);
        $notification->update($request->all());
        return redirect()->route('notifications.show',compact('notification'));
    }

    
    public function destroy($id)
    {
        
    }
}
