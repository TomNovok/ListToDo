<?php $handler = "/planseditor/index/" ?>
<div id='week_area'>
    <?php echo form_open($handler); ?>
        <table id="table" rules='all' border=1 class='table__table'>
            <?php
                for ($i=0; $i<7; $i++)
                {
                    echo "<tr>";
                    for ($j=0; $j<4; $j++)
                    {
                        if ($j==0 || $j==1)
                        {
                            $num = $i;
                            $dd = $dates[$num];
                            $fdd = $fdates[$num];
                        }
                        else
                        {                            
                            $num = $i+7;
                            $dd = $dates[$num];
                            $fdd = $fdates[$num];
                        }
                        if ($num == $cind)
                            $cl="table__current-day";
                        else
                            $cl="";
                        if ($i==5 || $i==6)
                            $cl2 = "table__weekend";
                        else
                            $cl2 = "table__weekday";
                        if ($i==0 && $j==0)
                        {
                            echo "<td rowspan=7 class='table__buttons-sideways-td' onclick=\"ajaxBackWeek('$page');\">";
                            echo "<input type='button' class='table__buttons-sideways' id='week_back' name='week_back' style=\"background-image: url('../../assets/images/chevron-thin-left.svg');\">";
                            echo "</td><td rowspan=7 class='table__empty-td'></td>";
                        }
                        if ($j==0 || $j==2)
                        {
                            echo "<td id='tdDay_$num' class='table__day-td $cl2' onclick='openNewPlanWidgets(event);'>";
                            echo "<h2 class='table__day'>".$fdd['day']."</h2>";
                            echo "<div class='table__month'>".$fdd['month']."</div>";
                            echo "<div class='table__day_of_week'>".$fdd['day_of_week']."</div>";
                            echo "</td>";
                        }
                        else
                        {
                            echo "<td class='table__plan-td droppable $cl' id='td_$num'>";
                            if (isset($plans[$dd]))
                            {
                                $l = count($plans[$dd]);
                                for ($k=0; $k<$l; $k++)
                                {
                                    $plan = $plans[$dd][$k];
                                    require("oneplan.php");
                                }
                            }
                            require("newplan.php");
                            echo "</td>";
                        }
                        if ($i==0 && $j==3)
                        {
                            echo "<td rowspan=7 class='table__empty-td'></td>";
                            echo "<td rowspan=7 class='table__buttons-sideways-td' onclick=\"ajaxFrontWeek('$page');\">";
                            echo "<input type='button' class='table__buttons-sideways' id='week_front' name='week_front' style=\"background-image: url('../../assets/images/chevron-thin-right.svg');\">";
                            echo "</td>";
                        }
                    }
                    echo "</tr>";
                }
            ?>  
        </table>
        <div id='ids_of_plans_json' style='display: none'><?php echo $ids_of_plans_json; ?></div>
    <?php echo form_close(); ?>
</div>