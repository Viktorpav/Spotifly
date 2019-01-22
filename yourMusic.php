<?php
include("includes/includedFiles.php");
?>

<div class="playListContainer">

	<div class="gridViewContainer">
		<h2>PLAYLIST</h2>

		<div class="buttonItems">
			<button class="button green" onclick="createPlaylist()">NEW PLAYLIST</button>
		</div>


			<?php

            $username = $userLoggedIn->getUsername();

			$playListQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");

			if(mysqli_num_rows($playListQuery) == 0) {
			    echo "<span class='noResults'>No playlists found matching</span>";
            }

			while ($row = mysqli_fetch_array($playListQuery)) {

			    $playlist = new Playlist($con, $row);

				echo "<div class='gridViewItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
                    
                       <div class='playListImage'>
                            <img src='assets/images/icons/playlist.png'>
                        </div>
                       
                       
                       <div class='gridViewInfo'>"
					        . $playlist->getName() .
					    "</div> 
                    
                </div>";


			}
			?>

        </div>

</div>




