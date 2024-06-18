if($import_to_user->residu_val >= $bat_import->bat_watt){
                                    $up_battery_imp = DB::table('battery')->where('id_users',$import_to_user->id_users)
                                    ->where('id_battery',$import_to_user->id_battery)->update([
                                        'bat_watt' => $bat_import->bat_watt,
                                        'residu_val' => $import_to_user->capacity - $bat_import->bat_watt,
                                    ]);

                                    $sum_bat_up = DB::table('battery')->where('id_users',$import_to_user->id_users)->sum('bat_watt');
                                    $sum_cap_up = DB::table('battery')->where('id_users',$import_to_user->id_users)->sum('capacity');
                                    $get_persentase_new = ($sum_bat_up / $sum_cap_up) * 100;

                                    $saldo_new = $cek_saldo - $bat_import->bat_watt;

                                    $up_to_us = DB::table('users')->where('id',$import_to_user->id_users)->update([
                                        'persentase' => $get_persentase_new,
                                        'saldo' => $saldo_new,
                                    ]);

                                    $cek_saldo -= $bat_import->bat_watt;
                                }else{
                                    
                                }