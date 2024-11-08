<?php
session_destroy();
echo '<script>window.location = "' . $path . '"</script>';
