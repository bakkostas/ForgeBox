<?php
	
		if(isset($_SESSION['USERID']) && $_SESSION['USERID']>0 && $_SESSION['USERID']!=7)
		{
		?>
	<script>
			
			var tincan = new TinCan (
            {
                url: window.location.href,
                activity: {
                    id: "<?php print $_SERVER['PHP_SELF']; ?>",
                    definition: {
                        name: {
                            "en-US": "FORGEBox - <?php print $_SERVER['PHP_SELF']; ?>"
                        },
                        description: {
                            "en-US": "FORGEBox - <?php print $_SERVER['PHP_SELF']; ?>"
                        }, 
                        type: "http://activitystrea.ms/schema/1.0/page"
                    }
                }
            }
        );

        tincan.sendStatement(
            {
				actor: {
					name: "<?php echo $_SESSION['FNAME'].' '.$_SESSION['LNAME']; ?>",
					mbox: "mailto:<?php echo $_SESSION['EMAIL']; ?>"
				  },
				  verb: {
					id: "http://adlnet.gov/expapi/verbs/experienced",
					display: {"en-US": "experienced"}
				},
				object: {
					id: "<?php print 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>",
					definition: {
						type: "http://adlnet.gov/expapi/activities/assessment",
						name: { "en-US": "<?php print $lrs_object_name; ?>" },
						extensions: {
							"<?php print 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>": "<?php print $_SERVER['PHP_SELF']; ?>"
						}
					}
				},
                context: {
					extensions: {
					  "<?php print 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>": "<?php print $_SERVER['PHP_SELF']; ?>"
					}
				},
				authority: {
					objectType: "Agent",
					name: "<?php echo $adminName; ?>",
					mbox: "mailto:<?php echo $adminEmail; ?>"
					
				}
            },
            function () {}
        );
</script>
			<?php
		}
		?>
