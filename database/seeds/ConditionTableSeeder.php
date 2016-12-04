<?php

use Illuminate\Database\Seeder;
use App\Condition;

class ConditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $conditions = [
            [ 'type'=>'11', 'name' => '11=新品','explain' =>'【新品】新品未使用となります。' ],
            [ 'type'=>'1', 'name' => '1=中古:ほぼ新品','explain' =>'【超美品】ほとんど使用のない状態となります。' ],
            [ 'type'=>'2', 'name' => '2=中古:非常に良い','explain' =>'【美品】◆動作確認済み◆本体のキズやスレはほぼなく状態は良好です。' ],
            [ 'type'=>'3', 'name' => '3=中古:良い','explain' =>'【美品】◆動作確認済み◆本体のキズやスレも少なく状態は良好です。' ],
            [ 'type'=>'4', 'name' => '4=中古:可','explain' =>'【美品】◆動作確認済み◆目立った大きなキズはありません。' ]
        ];
        foreach( $conditions as $condition ) {
          $condition_i = new Condition();
          $condition_i->type = $condition['type'];
          $condition_i->name = $condition['name'];
          $condition_i->explain = $condition['explain'];
          $condition_i->save();
        }
    }
}
