(function(){
  'use strict';
  var header = document.getElementById('site-header');
  var backTop = document.getElementById('back-top');
  function onScroll(){ var y=window.scrollY; if(header)header.classList.toggle('scrolled',y>10); if(backTop)backTop.classList.toggle('show',y>600); }
  window.addEventListener('scroll', onScroll, {passive:true}); onScroll();

  // Mobile nav toggle
  var toggle=document.getElementById('nav-toggle'); var nav=document.getElementById('site-nav');
  function closeNav(){ if(nav)nav.classList.remove('open'); if(toggle){toggle.classList.remove('open');toggle.setAttribute('aria-expanded','false');} document.body.style.overflow=''; }
  if(toggle&&nav){
    toggle.addEventListener('click',function(){ var open=nav.classList.toggle('open'); toggle.classList.toggle('open',open); toggle.setAttribute('aria-expanded',String(open)); document.body.style.overflow=open?'hidden':''; });
    nav.querySelectorAll('a').forEach(function(l){ l.addEventListener('click',closeNav); });
  }
  window.addEventListener('resize',function(){ if(window.innerWidth>992)closeNav(); });

  // FAQ accordion
  document.querySelectorAll('.faq-question').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.parentElement; var active=item.classList.contains('active');
      document.querySelectorAll('.faq-item').forEach(function(f){ f.classList.remove('active'); f.querySelector('.faq-question').setAttribute('aria-expanded','false'); });
      if(!active){ item.classList.add('active'); btn.setAttribute('aria-expanded','true'); }
    });
  });

  // Reveal on scroll
  var reveals=document.querySelectorAll('.reveal');
  if('IntersectionObserver' in window){
    var io=new IntersectionObserver(function(entries){ entries.forEach(function(en){ if(en.isIntersecting){ en.target.classList.add('visible'); io.unobserve(en.target); } }); },{threshold:.1});
    reveals.forEach(function(el){ io.observe(el); });
  } else { reveals.forEach(function(el){ el.classList.add('visible'); }); }

  // Smooth anchor
  document.querySelectorAll('a[href^="#"]').forEach(function(link){
    link.addEventListener('click',function(e){ var id=link.getAttribute('href'); if(id.length>1){ var t=document.querySelector(id); if(t){ e.preventDefault(); var off=(header?header.offsetHeight:76)+4; var top=t.getBoundingClientRect().top+window.scrollY-off; window.scrollTo({top:top,behavior:'smooth'}); } } });
  });

  // Calculator
  var run=document.getElementById('calc-run'); var res=document.getElementById('calc-result');
  if(run&&res){
    run.addEventListener('click',function(){
      var h=parseFloat(document.getElementById('calc-hours').value)||0;
      var d=parseFloat(document.getElementById('calc-days').value)||0;
      var r=parseFloat(document.getElementById('calc-rate').value)||0;
      if(!h||!d||!r){ res.innerHTML='Vul alle velden in.'; return; }
      var gross=h*d*4.33; var net=gross*0.78;
      res.innerHTML='Indicative net per month: &euro; '+net.toFixed(2).replace('.',',')+' <span style="font-weight:400;font-size:.9rem;color:var(--ink-light);display:block;margin-top:6px;">&#8226; gross &euro; '+gross.toFixed(2).replace('.',',')+'</span>';
    });
  }

  // Back to top
  if(backTop){ backTop.addEventListener('click',function(e){ e.preventDefault(); window.scrollTo({top:0,behavior:'smooth'}); }); }

  // Auto remove flash
  document.querySelectorAll('.flash').forEach(function(f){ setTimeout(function(){ f.remove(); },5000); });
})();
