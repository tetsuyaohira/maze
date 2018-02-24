<style> 
 .wall { background-color: black; color: gray; }
 .road { background-color: white; color: white; }
 pre { padding:12px; font-size:10px; line-height:10px; }
</style></head><body><pre>
<?php
// 迷路を作成して結果を出力する
$maze = generateMaze(21, 21);
echo drawMaze($maze);

// 迷路を作成する関数
function generateMaze($width = 55, $height = 55) {
  // 必ず奇数になるようにする
  $width = floor($width / 2) * 2 + 1;
  $height = floor($height / 2) * 2 + 1;
  // 迷路を初期化
  $maze = array();
  // 外周に壁を作る --- (*2)
  for ($y = 0; $y < $height; $y++) {
    $maze[$y] = array();
    for ($x = 0; $x < $width; $x++) {
      $maze[$y][$x] = 0;
      // 外周なら壁
      if ($x == 0 || ($x == ($width-1)) ||
          $y == 0 || ($y == ($height-1))) {
        $maze[$y][$x] = 1;
      }
    }
  }
  // 壁を設置 --- (*3)
  // 上下左右を表すテーブル
  $UDLR = [[0,-1],[0,1],[-1,0],[1,0]];
  for ($y = 2; $y < $height-2; $y += 2) {
    for ($x = 2; $x < $width-2; $x += 2) {
      // 一つおきに壁を作る --- (*4)
      $maze[$y][$x] = 1;   
      // 壁の上下左右のいずれかに壁を作る --- (*5)
      $r = $UDLR[mt_rand(0, 3)];
      $y2 = $y + $r[0];
      $x2 = $x + $r[1];
      $maze[$y2][$x2] = 1;
    }
  }
  return $maze;
}

// 迷路を描画する
function drawMaze($maze) {
  $pat = array();
  $pat[0] = "<span class='road'>0,</span>"; // 通路
  $pat[1] = "<span class='wall'>1,</span>"; // 壁
  $html = "";
  for ($y = 0; $y < count($maze); $y++) {
    for ($x = 0; $x < count($maze); $x++) {
      $html .= $pat[$maze[$y][$x]];
    }
    $html .= "\n";
  }
  return $html;
}



