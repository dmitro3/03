<?php 
/**
 * Template Name: Sports Main Page
 *
 * Sports Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header();
get_sidebar(); 

global $api_server_url;

$id = $sports_raw_post = $all_game_data = "";
if(isset($_GET['id'])){
  $id = $_GET['id'];
}
if(isset($id) && !empty($id)){
  $sports_games_data = $api_server_url . '/providers/odds-824215133479014/?token='.agereToken().'&casino='.agereCasino().'&action=getSportsInfo&sportKey='.$id;
  $sports_raw_post = json_decode(file_get_contents($sports_games_data));
}
?>
<div class="container">
    <div class="col-lg-12">
        <div class="content content-transparent tab-content">
            <div class="tab-pane active" id="tab1">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:20%; text-align: center;">Game Time</th>
                            <th style="width:20%; text-align: center;">Team Name</th>
                            <th style="width:20%; text-align: center;">Money Line</th>
                            <th style="width:20%; text-align: center;">Spreads</th>
                            <th style="width:20%; text-align: center;">Totals</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($sports_raw_post->data) ) {
                            foreach ($sports_raw_post->data as $key => $all_game_data) {
                                $commence_time = $all_game_data->commence_time;
                                
                                $all_game_data = $all_game_data->bookmakers;
                                
                                if(isset($all_game_data)){
                                    foreach ($all_game_data as $key => $value) {
                                       
                                        if(isset($value->markets)){
        
                                            $markets_data = $value->markets;

                                            $markets_data_0 = "";
                                            $markets_data_1 = "";
                                            $markets_data_2 = "";
                                            foreach ($markets_data as $key => $markets_value) {
                                                if(isset($markets_value->h2h)){
                                                    $markets_data_0 = $markets_value->h2h;
                                                }elseif(isset($markets_value->spreads)){
                                                    $markets_data_1 = $markets_value->spreads;
                                                }elseif(isset($markets_value->totals)){
                                                    $markets_data_2 = $markets_value->totals;
                                                }
                                            }

                                            if(isset($markets_data_0->outcomes))    $markets_data_0 = $markets_data_0->outcomes;
                                            if(isset($markets_data_1->outcomes))    $markets_data_1 = $markets_data_1->outcomes;
                                            if(isset($markets_data_2->outcomes))    $markets_data_2 = $markets_data_2->outcomes;

                                            for($i=0;$i<=1;$i++){
                                                ?>
                                                <tr>
                                                    <td style="width:20%;text-align: center;"><?php 
                                                        if($i == 0 && isset($commence_time) && !empty($commence_time)){
                                                            echo date("m-d-Y g:i a", strtotime( $value->last_update) );
                                                        }
                                                    ?></td>
        
                                                    <td style="width:20%;text-align: center;" data-name="Away Name"><?php if(isset($markets_data_0[$i]->name) && !empty($markets_data_0[$i]->name)){ echo $markets_data_0[$i]->name; } elseif(isset($markets_data_1[$i]->name) && !empty($markets_data_1[$i]->name))  {echo $markets_data_1[$i]->name; } else { echo $markets_data_2[$i]->name; }  ?>
                                                    </td>
                                                    <td style="width:15%;text-align: center;">
                                                      
                                                    <?php 
                                                        if(isset($markets_data_0[$i]->point)){ 
                                                            
                                                            $url1 = "&maxMoneyline=500";
                                                            ?>
                                                            <p class="game-points"><a class="add_cart_link_01" data-href="?add-to-cart=752220&gamename=<?php if(isset($markets_data_0[$i]->name)){ echo $markets_data_0[$i]->name; }  ?>&moneyline=<?php echo $markets_data_0[$i]->point; ?><?php echo $url1; ?>"><?php echo $markets_data_0[$i]->point; ?></a></p>
                                                            <?php
                                                        }
                                                        $url1 = "&maxMoneyline=500";
                                                        ?>
                                                        <p class="game-price"><a class="add_cart_link_01" data-href="?add-to-cart=752220&gamename=<?php if(isset($markets_data_0[$i]->name)){ echo $markets_data_0[$i]->name; }  ?>&moneyline=<?php echo $markets_data_0[$i]->price; ?><?php echo $url1; ?>"><?php if(isset($markets_data_0[$i]->price)){ echo $markets_data_0[$i]->price; }  ?></a></p>
                                                      
                                                    </td>
                                                    <td style="width:15%;text-align: center;">
                                                        <?php 
                                                        if(isset($markets_data_1[$i]->point)){
                                                            
                                                            if(isset($markets_data_1[$i]->price)){
                                                                $url2 = " ".$markets_data_1[$i]->price;
                                                            }
                                                            ?>
                                                            <p class="game-points"><a class="add_cart_link_01" data-href="?add-to-cart=752220&gamename=<?php if(isset($markets_data_0[$i]->name)){ echo $markets_data_0[$i]->name; }  ?>&spreads=<?php  echo $markets_data_1[$i]->point; ?><?php echo $url2; ?>"><?php  echo $markets_data_1[$i]->point; ?></a></p>
                                                            <?php
                                                        }   
                                                        ?>
                                                        
                                                        <p class="game-price"><?php if(isset($markets_data_1[$i]->price)){ echo $markets_data_1[$i]->price; }  ?></p>
                                                    </td>
                                                    <td style="width:15%;text-align: center;">
                                                        <?php 
                                                        if(isset($markets_data_2[$i]->point)){ 
                                                                    
                                                            if(isset($markets_data_2[$i]->price)){
                                                                $url3 = " ".$markets_data_2[$i]->price;
                                                            }
                                                            ?>
                                                                <p class="game-points"><?php if($i==0) { echo "Ov";} else {echo "Un"; }  ?> <a class="add_cart_link_01" data-href="?add-to-cart=752220&gamename=<?php if(isset($markets_data_0[$i]->name)){ echo $markets_data_0[$i]->name; }  ?>&totals=<?php  echo $markets_data_2[$i]->point; ?><?php echo $url3; ?>"><?php echo $markets_data_2[$i]->point; ?></a></p>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p class="game-price"><?php if(isset($markets_data_2[$i]->price)){ echo $markets_data_2[$i]->price; }  ?></p>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab2"></div>
        </div>
    </div>
</div>
<?php get_footer(); ?>