<?php


 $db =mysqli_connect('localhost', 'aaa','aaa','registration');
// lets assume a user is logged in with id $user_id
$user_id = $_SESSION['userid'];
$post_id;
// if user clicks like or dislike button
if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO drip_rating (userid, con_num, rating_action)
         	   VALUES ($user_id, $post_id, 'like')
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO drip_rating (userid, con_num, rating_action)
               VALUES ($user_id, $post_id, 'dislike')
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM drip_rating WHERE userid=$user_id AND con_num=$post_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM drip_rating WHERE userid=$user_id AND con_num=$post_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($db, $sql);
  echo getRating($post_id);
  exit(0);
}

// Get total number of likes for a particular post
function getLikes($idx)
{
  global $db;
  $sql = "SELECT COUNT(*) FROM drip_rating
  		  WHERE con_num = $idx AND rating_action='like'";
  $rs = mysqli_query($db, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($idx)
{
  global $db;
  $sql = "SELECT COUNT(*) FROM drip_rating
  		  WHERE con_num = $idx AND rating_action='dislike'";
  $rs = mysqli_query($db, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($idx)
{
  global $db;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM drip_rating WHERE con_num = $idx AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM drip_rating
		  			WHERE con_num = $idx AND rating_action='dislike'";
  $likes_rs = mysqli_query($db, $likes_query);
  $dislikes_rs = mysqli_query($db, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($idx)
{
  global $db;
  global $user_id;
  $sql = "SELECT * FROM drip_rating WHERE userid=$user_id
  		  AND con_num=$idx AND rating_action='like' ";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($idx)
{
  global $db;
  global $user_id;
  $sql = "SELECT * FROM drip_rating WHERE userid=$user_id
  		  AND con_num=$idx AND rating_action='dislike'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// $sql = "SELECT * FROM drip";
// $result = mysqli_query($db, $sql);
// // fetch all posts from database
// // return them as an associative array called $posts
// $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
