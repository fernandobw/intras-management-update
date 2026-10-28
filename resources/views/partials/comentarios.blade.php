<button id="show-comments-button" class="commentsBtn" onclick="disqus();return false;" style="display: block; float: none; margin: 20px auto;"> Comentar / Ver comentarios </button>

<div id="disqus_thread"></div>

<script>
    let disqus_loaded = false;
    const disqus_shortname = 'management-update';

    const disqus = () => {
        d = document;
        if (!disqus_loaded) {
            location.hash = 'comentarios';
            disqus_loaded = true;
            const s = d.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            s.src = "//" + disqus_shortname + ".disqus.com/embed.js";
            (d.head || d.body).appendChild(s);
            //Hide the button after opening
            d.getElementById("show-comments-button").style.display = "none";
        }
    }

    //Opens comments when linked to directly
    const hash = window.location.hash.substr(1);

    if (hash === 'comentarios') {
        if (!disqus_loaded) {
            disqus();
        }
    }
</script>