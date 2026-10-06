(function () {
  var root = document.documentElement;
  root.classList.add("js");
  var params = new URLSearchParams(window.location.search);
  var quote = params.get("quote");
  if (quote === "sent" || quote === "invalid") {
    root.setAttribute("data-quote", quote);
    var banner = document.getElementById("quote-banner");
    if (banner) banner.scrollIntoView({ block: "nearest" });
  }

  var toggle = document.querySelector("[data-nav-toggle]");
  var nav = document.querySelector("[data-nav]");
  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    nav.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      });
    });
    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      }
    });
  }

  document.querySelectorAll("[data-quote-form]").forEach(function (form) {
    var redirect = form.querySelector('input[name="redirect"]');
    if (redirect) redirect.value = window.location.pathname;
    var host = window.location.hostname;
    var local = host === "localhost" || host === "127.0.0.1";
    if (local) return;
    form.action = "https://formsubmit.co/info@als-cleaning.com";
    form.method = "POST";
    var next = window.location.origin + window.location.pathname + "?quote=sent#quote-banner";
    [
      ["_subject", "Free walkthrough request from the website"],
      ["_template", "table"],
      ["_captcha", "false"],
      ["_next", next],
    ].forEach(function (pair) {
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = pair[0];
      input.value = pair[1];
      form.appendChild(input);
    });
    var honey = document.createElement("input");
    honey.type = "text";
    honey.name = "_honey";
    honey.tabIndex = -1;
    honey.autocomplete = "off";
    honey.className = "hp";
    honey.setAttribute("aria-hidden", "true");
    form.appendChild(honey);
    document.querySelectorAll(".local-note").forEach(function (note) {
      note.remove();
    });
  });

  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var nodes = document.querySelectorAll(
    ".hero-copy, .hero-card, .trust-item, .card, .steps li, .promise, .city-grid li, .section-head, .gallery figure, .faq details, .quote-form, .clients li, .split > div"
  );
  nodes.forEach(function (el, index) {
    el.classList.add("reveal");
    el.style.setProperty("--d", (index % 4) * 80 + "ms");
  });
  if (!reduce && "IntersectionObserver" in window) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          entry.target.classList.add("is-in");
          observer.unobserve(entry.target);
        });
      },
      { threshold: 0.16, rootMargin: "0px 0px -8% 0px" }
    );
    nodes.forEach(function (el) {
      observer.observe(el);
    });
  } else {
    nodes.forEach(function (el) {
      el.classList.add("is-in");
    });
  }

  var bar = document.querySelector("[data-progress]");
  var header = document.querySelector(".site-header");
  var heroImg = document.querySelector("[data-parallax] img");
  var process = document.querySelector(".process");
  var story = document.querySelector("[data-story]");
  var storyFrames = story ? story.querySelectorAll("[data-story-frame]") : [];
  var storyCards = story ? story.querySelectorAll("[data-story-card]") : [];
  var storyJumps = story ? story.querySelectorAll("[data-story-jump]") : [];
  var storyFill = story ? story.querySelector("[data-story-fill]") : null;
  var storyLive = story ? story.querySelector("[data-story-live]") : null;
  var storyCount = storyFrames.length;
  var storyIndex = -1;
  var storySound = false;
  var reel = document.querySelector("[data-reel]");
  var reelTrack = reel ? reel.querySelector("[data-reel-track]") : null;

  function setSoundButtons(on) {
    document.querySelectorAll("[data-sound]").forEach(function (button) {
      button.textContent = on ? "Mute" : "Play with sound";
      button.setAttribute("aria-pressed", on ? "true" : "false");
    });
  }

  document.querySelectorAll("[data-sound]").forEach(function (button) {
    button.addEventListener("click", function (event) {
      event.preventDefault();
      var frame = button.closest("[data-story-frame]");
      var video = frame ? frame.querySelector("video") : null;
      if (!video) return;
      if (!video.muted && storySound) {
        storySound = false;
        video.muted = true;
        setSoundButtons(false);
        return;
      }
      storySound = true;
      if (video.ended) video.currentTime = 0;
      video.muted = false;
      video.volume = 1;
      var pending = video.play();
      if (pending && pending.catch) pending.catch(function () {});
      setSoundButtons(true);
    });
  });

  document.querySelectorAll(".film-grid video").forEach(function (video) {
    video.controls = true;
    video.muted = false;
    video.volume = 1;
    video.addEventListener("play", function () {
      video.muted = false;
      if (video.volume === 0) video.volume = 1;
    });
  });

  if (reduce) {
    document.querySelectorAll("[data-story] video").forEach(function (video) {
      video.setAttribute("controls", "");
      video.removeAttribute("loop");
    });
  }

  function playChapter(index) {
    storyFrames.forEach(function (frame, i) {
      var on = i === index;
      frame.classList.toggle("is-on", on);
      var video = frame.querySelector("video");
      if (!video) return;
      if (on && !reduce) {
        video.muted = !storySound;
        video.volume = 1;
        var pending = video.play();
        if (pending && pending.catch) {
          pending.catch(function () {
            video.muted = true;
            var again = video.play();
            if (again && again.catch) again.catch(function () {});
          });
        }
      } else {
        video.pause();
      }
    });
    storyCards.forEach(function (card, i) {
      card.classList.toggle("is-on", i === index);
    });
    storyJumps.forEach(function (button, i) {
      if (i === index) button.setAttribute("aria-current", "step");
      else button.removeAttribute("aria-current");
    });
    if (storyLive && storyCards[index]) {
      var heading = storyCards[index].querySelector("h2");
      storyLive.textContent = "Chapter " + (index + 1) + ". " + (heading ? heading.textContent : "");
    }
  }

  if (story && storyCount) {
    storyJumps.forEach(function (button) {
      button.addEventListener("click", function () {
        var index = Number(button.getAttribute("data-story-jump")) || 0;
        if (reduce || !story.classList.contains("story-scroll")) {
          var slide = story.querySelectorAll(".story-slide")[index];
          if (slide) slide.scrollIntoView({ block: "start" });
          return;
        }
        var travel = Math.max(1, story.offsetHeight - window.innerHeight);
        var top = story.getBoundingClientRect().top + (window.scrollY || 0) + ((index + 0.5) / storyCount) * travel;
        window.scrollTo({ top: top, behavior: "smooth" });
      });
    });
  }

  var ticking = false;
  function onScroll() {
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(function () {
      var scrolled = window.scrollY || 0;
      var view = window.innerHeight || 1;
      var max = Math.max(1, document.documentElement.scrollHeight - view);
      if (bar) bar.style.width = Math.min(100, (scrolled / max) * 100) + "%";
      if (header) header.classList.toggle("is-scrolled", scrolled > 8);
      if (heroImg && !reduce) {
        var shift = Math.min(70, scrolled * 0.16);
        heroImg.style.transform = "translate3d(0," + shift + "px,0) scale(1.08)";
      }
      if (process && !reduce) {
        var rect = process.getBoundingClientRect();
        var amount = (view - rect.top) / (rect.height + view);
        process.style.setProperty("--fill", String(Math.max(0, Math.min(1, amount))));
      }
      if (story && storyCount && !reduce) {
        var storyRect = story.getBoundingClientRect();
        var travel = Math.max(1, story.offsetHeight - view);
        var progress = Math.max(0, Math.min(1, -storyRect.top / travel));
        var index = Math.min(storyCount - 1, Math.floor(progress * storyCount));
        var seen = storyRect.bottom > 0 && storyRect.top < view;
        if (storyFill) storyFill.style.transform = "scaleX(" + progress + ")";
        if (!seen) {
          if (storyIndex !== -1) {
            storyFrames.forEach(function (frame) {
              var video = frame.querySelector("video");
              if (video) video.pause();
            });
            storyIndex = -1;
          }
        } else if (index !== storyIndex) {
          storyIndex = index;
          playChapter(index);
        }
      }
      if (reel && reelTrack && !reduce && window.innerWidth >= 980) {
        var reelRect = reel.getBoundingClientRect();
        var reelTravel = Math.max(1, reel.offsetHeight - view);
        var reelProgress = Math.max(0, Math.min(1, -reelRect.top / reelTravel));
        var windowBox = reelTrack.parentElement;
        var shiftMax = Math.max(0, reelTrack.scrollWidth - (windowBox ? windowBox.clientWidth : 0));
        reelTrack.style.transform = "translate3d(" + (-reelProgress * shiftMax) + "px,0,0)";
      } else if (reelTrack) {
        reelTrack.style.transform = "";
      }
      ticking = false;
    });
  }
  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onScroll, { passive: true });
})();
