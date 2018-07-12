function pop_hyperv_video() {	
            document.getElementById('hyperv_video').style.display='block';
            document.getElementById('hyperv_video').style.zIndex='6';
            document.getElementById('hyperv_video_balise').innerHTML = '<iframe width="853" height="480" style="background: #000; border: solid #000 5px;" src="http://www.youtube.com/embed/b5R_-kn28WI?version=3&autoplay=1" frameborder="0" allowfullscreen></iframe>';
        }

        function pop_hyperv_video_exit() {	
            document.getElementById('hyperv_video').style.display='none';
            document.getElementById('hyperv_video').style.zIndex='-1';
            document.getElementById('hyperv_video_balise').innerHTML = '';
        }