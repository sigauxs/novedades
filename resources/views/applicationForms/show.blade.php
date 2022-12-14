<x-app-layout>

    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-lg mx-auto mt-10">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-center">
                 
                    <tr class="bg-gray-800 border-b rounded border" style="position: relative">

                      <td colspan="2" class="text-white px-4 py-2"> Detalles
                          <a href="{{ route('applicationForms.index') }}">
                            <span class="material-icons" style="color:white; font-size:26px ; position:absolute; left:10px">home</span></a>
                          <a href="{{ url()->previous()}}">
                            <span class="material-icons" style="color:white; font-size:26px ; position:absolute; right:10px">arrow_back</span>
                            <span class="material-symbols-outlined">

                                </span>
                          </a>
                     </td>
                    </tr>
                    <tr class="bg-white border-b">
                        <td scope="col" class="text-sm font-medium px-6 py-4">
                           Soporte entregado
                        </td>
                        <td scope="col" class="text-sm font-medium  px-6 py-4">
                        @if ($applicationForm->support != 'null')
                            {{$applicationForm->support ? 'Entregado' : 'No entregado'}}
                        @else
                            No entregado
                        @endif
                        </td>
                    </tr>
                    <tr class="bg-white border-b">
                        <td scope="col" class="text-sm font-medium px-6 py-4">
                           Tipo de identificación
                        </td>
                        <td scope="col" class="text-sm font-medium  px-6 py-4">

                        {{$applicationForm->identificationType->name}}

                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <td scope="col" class="text-sm font-medium px-6 py-4">
                          Identification
                        </td>
                        <td scope="col" class="text-sm font-medium  px-6 py-4">
                            {{ $applicationForm->Employee->identification}}
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                      <td scope="col" class="text-sm font-medium px-6 py-4">
                        Empleados
                      </td>
                      <td scope="col" class="text-sm font-medium  px-6 py-4">
                          {{ $applicationForm->Employee->first_name}}  {{ $applicationForm->Employee->last_name}}
                      </td>
                    </tr>

                    <tr class="bg-white border-b">
                      <td scope="col" class="text-sm font-medium px-6 py-4">
                        cargo
                      </td>
                      <td scope="col" class="text-sm font-medium  px-6 py-4">
                          {{ $applicationForm->Employee->position->name}}
                      </td>
                    </tr>


                    <tr class="bg-white border-b">
                      <td scope="col" class="text-sm font-medium px-6 py-4">
                        Jefe Inmedianto
                      </td>
                      <td scope="col" class="text-sm font-medium  px-6 py-4">
                          {{ $applicationForm->boss->fullname}}
                      </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Centro de costo</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                         {{$applicationForm->centerCost->name}}
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Tipo de novedad</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{$applicationForm->notificationType->name}}
                      </td>
                    </tr class="bg-white border-b">

                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Fecha de inicio</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{\Carbon\Carbon::parse($applicationForm->started_date )->translatedFormat('j F, Y ')}} {{\Carbon\Carbon::parse($applicationForm->started_time )->translatedFormat('h:i:s A') }}
                      </td>
                    </tr class="bg-white border-b">


                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Fecha de Finalizacion</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{  \Carbon\Carbon::parse($applicationForm->finish_date )->translatedFormat('j F, Y') }} {{\Carbon\Carbon::parse($applicationForm->finish_time)->translatedFormat('h:i:s A') }}
                      </td>
                    </tr class="bg-white border-b">

                    
                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total de dias</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{ $applicationForm->total_days }}
                    </td>
                    </tr class="bg-white border-b">
                                    

                 
                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total de horas permisos</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{ $applicationForm->total_hours }}
                      </td>
                    </tr>
         
                   

                    <tr class="bg-white border-b">
                      <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Observaciones</td>

                    </tr class="bg-white border-b">

                    <tr class="bg-white border-b">
                      <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $applicationForm->observation}}</td>

                    </tr class="bg-white border-b">


                  </table>
                </div>
              </div>
            </div>
          </div>


     </div>
     <div class="container mx-auto">

       <div class="grid grid-cols-2 max-w-lg mx-auto text-center">
           <div class="">
               <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded w-40"> <a href="{{route('notifications.edit',$applicationForm) }}">Editar</a> </button>
            </div>
           <div class="mb-10">
            <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded w-40"> <a href="{{ url()->previous()}}">Regresar</a> </button>
           </div>


       </div>



    </div>



</x-app-layout>
