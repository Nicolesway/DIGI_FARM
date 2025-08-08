(function() {
  const STORAGE_KEYS = {
    users: 'df_users',
    currentUser: 'df_current_user',
    experts: 'df_experts',
    supplies: 'df_supplies',
    services: 'df_services',
    products: 'df_products',
    reqService: 'df_req_service',
    reqExpert: 'df_req_expert',
    reqSupply: 'df_req_supply'
  };

  function readStore(key, fallback) {
    try {
      const raw = localStorage.getItem(key);
      return raw ? JSON.parse(raw) : fallback;
    } catch {
      return fallback;
    }
  }

  function writeStore(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
  }

  function generateId(prefix) {
    return `${prefix}_${Math.random().toString(36).slice(2, 8)}_${Date.now().toString(36)}`;
  }

  function seedOnce() {
    const seeded = readStore('df_seeded', false);
    if (seeded) return;

    const users = readStore(STORAGE_KEYS.users, []);
    if (!users.find(u => u.contact === 'admin@digifarm')) {
      users.push({ id: generateId('user'), name: 'Administrator', contact: 'admin@digifarm', role: 'admin', password: 'admin123' });
    }

    const experts = readStore(STORAGE_KEYS.experts, [
      { id: generateId('exp'), name: 'Dr. Amina W.', contact: '+254 700 111 222', specialization: 'Veterinary' },
      { id: generateId('exp'), name: 'Eng. Joseph K.', contact: '+254 700 333 444', specialization: 'Irrigation' },
      { id: generateId('exp'), name: 'Ms. Clara O.', contact: '+254 700 555 666', specialization: 'Agronomy' }
    ]);

    const supplies = readStore(STORAGE_KEYS.supplies, [
      { id: generateId('sup'), category: 'Tools', name: 'Sturdy Hoe', contact: '+254 701 000 111' },
      { id: generateId('sup'), category: 'Tools', name: 'Irrigation Kit', contact: '+254 701 000 222' },
      { id: generateId('sup'), category: 'Fertilizers', name: 'NPK 17:17:17 (50kg)', contact: '+254 701 000 333' },
      { id: generateId('sup'), category: 'Fertilizers', name: 'Urea (50kg)', contact: '+254 701 000 444' },
      { id: generateId('sup'), category: 'Seeds', name: 'Maize Hybrid H614', contact: '+254 701 000 555' },
      { id: generateId('sup'), category: 'Seeds', name: 'Tomato F1 Quality', contact: '+254 701 000 666' }
    ]);

    const services = readStore(STORAGE_KEYS.services, [
      { id: generateId('srv'), name: 'County Vet Team', contact: '+254 720 800 111', service: 'Veterinary' },
      { id: generateId('srv'), name: 'Soil Health Lab', contact: '+254 720 800 222', service: 'Soil Testing' },
      { id: generateId('srv'), name: 'GreenField Mechanics', contact: '+254 720 800 333', service: 'Machinery & Equipment' }
    ]);

    const products = readStore(STORAGE_KEYS.products, [
      { id: generateId('prd'), name: 'Fresh Tomatoes (20kg)', price: 1800, contact: '+254 711 222 333', sellerName: 'Sample Farmer' },
      { id: generateId('prd'), name: 'Maize (90kg bag)', price: 5400, contact: '+254 744 555 666', sellerName: 'Sample Farmer' }
    ]);

    writeStore(STORAGE_KEYS.users, users);
    writeStore(STORAGE_KEYS.experts, experts);
    writeStore(STORAGE_KEYS.supplies, supplies);
    writeStore(STORAGE_KEYS.services, services);
    writeStore(STORAGE_KEYS.products, products);
    writeStore(STORAGE_KEYS.reqService, []);
    writeStore(STORAGE_KEYS.reqExpert, []);
    writeStore(STORAGE_KEYS.reqSupply, []);

    writeStore('df_seeded', true);
  }

  function getCurrentUser() {
    return readStore(STORAGE_KEYS.currentUser, null);
  }

  function setCurrentUser(user) {
    writeStore(STORAGE_KEYS.currentUser, user);
  }

  function ensureNumber(value) {
    const num = Number(value);
    return Number.isFinite(num) ? num : 0;
  }

  function renderStats() {
    const products = readStore(STORAGE_KEYS.products, []);
    const experts = readStore(STORAGE_KEYS.experts, []);
    const services = readStore(STORAGE_KEYS.services, []);
    const $p = document.getElementById('statProducts');
    const $e = document.getElementById('statExperts');
    const $s = document.getElementById('statServices');
    if ($p) $p.textContent = String(products.length);
    if ($e) $e.textContent = String(experts.length);
    if ($s) $s.textContent = String(services.length);
  }

  function el(tag, className, html) {
    const node = document.createElement(tag);
    if (className) node.className = className;
    if (html !== undefined) node.innerHTML = html;
    return node;
  }

  function renderExperts() {
    const experts = readStore(STORAGE_KEYS.experts, []);
    const list = document.getElementById('expertsList');
    list.innerHTML = '';
    experts.forEach(exp => {
      const card = el('div', 'card-item');
      const h = el('h4', null, exp.name);
      const spec = el('div', 'badge', exp.specialization);
      const contact = el('div', 'muted', exp.contact);
      card.appendChild(h);
      card.appendChild(spec);
      card.appendChild(contact);
      list.appendChild(card);
    });
  }

  function renderProducts() {
    const products = readStore(STORAGE_KEYS.products, []);
    const list = document.getElementById('productsList');
    list.innerHTML = '';
    products.forEach(p => {
      const card = el('div', 'card-item');
      const h = el('h4', null, p.name);
      const price = el('div', 'badge', `KSh ${ensureNumber(p.price).toLocaleString()}`);
      const contact = el('div', 'muted', `${p.contact}${p.sellerName ? ' · ' + p.sellerName : ''}`);
      card.appendChild(h);
      card.appendChild(price);
      card.appendChild(contact);
      list.appendChild(card);
    });
  }

  function renderSupplies() {
    const supplies = readStore(STORAGE_KEYS.supplies, []);
    const tools = document.getElementById('supplyListTools');
    const ferts = document.getElementById('supplyListFertilizers');
    const seeds = document.getElementById('supplyListSeeds');
    tools.innerHTML = '';
    ferts.innerHTML = '';
    seeds.innerHTML = '';
    supplies.forEach(s => {
      const card = el('div', 'card-item');
      const h = el('h4', null, s.name);
      const badge = el('div', 'badge', s.category);
      const contact = el('div', 'muted', s.contact);
      card.appendChild(h);
      card.appendChild(badge);
      card.appendChild(contact);
      if (s.category === 'Tools') tools.appendChild(card);
      else if (s.category === 'Fertilizers') ferts.appendChild(card);
      else seeds.appendChild(card);
    });
  }

  function renderServices() {
    const services = readStore(STORAGE_KEYS.services, []);
    const list = document.getElementById('servicesList');
    list.innerHTML = '';
    services.forEach(s => {
      const card = el('div', 'card-item');
      const h = el('h4', null, s.name);
      const badge = el('div', 'badge', s.service);
      const contact = el('div', 'muted', s.contact);
      card.appendChild(h);
      card.appendChild(badge);
      card.appendChild(contact);
      list.appendChild(card);
    });
  }

  function renderAdminRequests() {
    const serviceReqs = readStore(STORAGE_KEYS.reqService, []);
    const expertReqs = readStore(STORAGE_KEYS.reqExpert, []);
    const supplyReqs = readStore(STORAGE_KEYS.reqSupply, []);

    const $sr = document.getElementById('adminServiceRequests');
    const $er = document.getElementById('adminExpertRequests');
    const $ir = document.getElementById('adminSupplyRequests');

    if ($sr) {
      $sr.innerHTML = '';
      serviceReqs.forEach(r => {
        const item = el('div', 'list-item');
        item.textContent = `${r.name} · ${r.service} · ${r.contact} — ${r.details}`;
        $sr.appendChild(item);
      });
    }
    if ($er) {
      $er.innerHTML = '';
      expertReqs.forEach(r => {
        const item = el('div', 'list-item');
        item.textContent = `${r.name} · ${r.specialization} · ${r.contact} — ${r.message}`;
        $er.appendChild(item);
      });
    }
    if ($ir) {
      $ir.innerHTML = '';
      supplyReqs.forEach(r => {
        const item = el('div', 'list-item');
        item.textContent = `${r.name} · ${r.category} · ${r.item} (${r.quantity}) · ${r.contact}`;
        $ir.appendChild(item);
      });
    }
  }

  function applyAuthUI() {
    const user = getCurrentUser();
    const $admin = document.getElementById('admin');
    const $adminLink = document.getElementById('adminNavLink');
    const $welcome = document.getElementById('welcomeUser');
    const $btnAuth = document.getElementById('btnShowAuth');
    const $btnLogout = document.getElementById('btnLogout');
    const $farmerActions = document.getElementById('farmerActions');
    const $farmerProducts = document.getElementById('farmerProducts');

    if (user) {
      $welcome.hidden = false;
      $welcome.textContent = `Hi, ${user.name}`;
      $btnAuth.hidden = true;
      $btnLogout.hidden = false;
    } else {
      $welcome.hidden = true;
      $btnAuth.hidden = false;
      $btnLogout.hidden = true;
    }

    if (user && user.role === 'admin') {
      $admin.hidden = false;
      $adminLink.hidden = false;
    } else {
      $admin.hidden = true;
      $adminLink.hidden = true;
    }

    if (user && user.role === 'farmer') {
      $farmerActions.hidden = false;
      $farmerProducts.hidden = false;
    } else {
      $farmerActions.hidden = true;
      $farmerProducts.hidden = true;
    }
  }

  function bindTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const panels = document.querySelectorAll('.tab-panel');
    tabButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        tabButtons.forEach(b => b.classList.remove('active'));
        panels.forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        const id = btn.getAttribute('data-tab');
        document.getElementById(id).classList.add('active');
      });
    });
  }

  function bindAuth() {
    const regForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');
    const showAuthBtn = document.getElementById('btnShowAuth');
    const btnLogout = document.getElementById('btnLogout');

    showAuthBtn.addEventListener('click', () => {
      document.getElementById('farmer').scrollIntoView({ behavior: 'smooth' });
    });

    btnLogout.addEventListener('click', () => {
      setCurrentUser(null);
      applyAuthUI();
    });

    regForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const form = new FormData(regForm);
      const name = String(form.get('name') || '').trim();
      const contact = String(form.get('contact') || '').trim();
      const role = String(form.get('role') || 'farmer');
      const password = String(form.get('password') || '');
      if (!name || !contact || !password) return;
      const users = readStore(STORAGE_KEYS.users, []);
      if (users.find(u => u.contact === contact)) {
        alert('Contact already registered. Please login.');
        return;
      }
      const user = { id: generateId('user'), name, contact, role, password };
      users.push(user);
      writeStore(STORAGE_KEYS.users, users);
      setCurrentUser(user);
      applyAuthUI();
      regForm.reset();
      alert('Registration successful. You are now logged in.');
    });

    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const form = new FormData(loginForm);
      const contact = String(form.get('contact') || '').trim();
      const password = String(form.get('password') || '');
      const users = readStore(STORAGE_KEYS.users, []);
      const user = users.find(u => u.contact === contact && u.password === password);
      if (!user) {
        alert('Invalid credentials');
        return;
      }
      setCurrentUser(user);
      applyAuthUI();
      loginForm.reset();
      alert(`Welcome back, ${user.name}`);
    });
  }

  function bindAdminForms() {
    const formExpertAdd = document.getElementById('formExpertAdd');
    const formSupplyAdd = document.getElementById('formSupplyAdd');
    const formServiceAdd = document.getElementById('formServiceAdd');

    formExpertAdd.addEventListener('submit', (e) => {
      e.preventDefault();
      const fd = new FormData(formExpertAdd);
      const expert = {
        id: generateId('exp'),
        name: String(fd.get('name') || '').trim(),
        contact: String(fd.get('contact') || '').trim(),
        specialization: String(fd.get('specialization') || '').trim()
      };
      if (!expert.name || !expert.contact || !expert.specialization) return;
      const experts = readStore(STORAGE_KEYS.experts, []);
      experts.push(expert);
      writeStore(STORAGE_KEYS.experts, experts);
      renderExperts();
      renderStats();
      formExpertAdd.reset();
    });

    formSupplyAdd.addEventListener('submit', (e) => {
      e.preventDefault();
      const fd = new FormData(formSupplyAdd);
      const item = {
        id: generateId('sup'),
        category: String(fd.get('category') || 'Tools'),
        name: String(fd.get('name') || '').trim(),
        contact: String(fd.get('contact') || '').trim()
      };
      if (!item.name || !item.contact) return;
      const supplies = readStore(STORAGE_KEYS.supplies, []);
      supplies.push(item);
      writeStore(STORAGE_KEYS.supplies, supplies);
      renderSupplies();
      formSupplyAdd.reset();
    });

    formServiceAdd.addEventListener('submit', (e) => {
      e.preventDefault();
      const fd = new FormData(formServiceAdd);
      const srv = {
        id: generateId('srv'),
        name: String(fd.get('name') || '').trim(),
        contact: String(fd.get('contact') || '').trim(),
        service: String(fd.get('service') || '').trim()
      };
      if (!srv.name || !srv.contact || !srv.service) return;
      const services = readStore(STORAGE_KEYS.services, []);
      services.push(srv);
      writeStore(STORAGE_KEYS.services, services);
      renderServices();
      renderStats();
      formServiceAdd.reset();
    });
  }

  function bindFarmerForms() {
    const formReqService = document.getElementById('formRequestService');
    const formReqExpert = document.getElementById('formRequestExpert');
    const formReqSupply = document.getElementById('formRequestSupply');
    const formPostProduct = document.getElementById('formPostProduct');

    formReqService.addEventListener('submit', (e) => {
      e.preventDefault();
      const user = getCurrentUser();
      if (!user) { alert('Please login first'); return; }
      const fd = new FormData(formReqService);
      const req = {
        id: generateId('rqS'),
        name: user.name,
        contact: String(fd.get('contact') || '').trim(),
        service: String(fd.get('service') || '').trim(),
        details: String(fd.get('details') || '').trim(),
        ts: Date.now()
      };
      if (!req.contact || !req.service || !req.details) return;
      const arr = readStore(STORAGE_KEYS.reqService, []);
      arr.unshift(req);
      writeStore(STORAGE_KEYS.reqService, arr);
      renderAdminRequests();
      formReqService.reset();
      alert('Service request submitted.');
    });

    formReqExpert.addEventListener('submit', (e) => {
      e.preventDefault();
      const user = getCurrentUser();
      if (!user) { alert('Please login first'); return; }
      const fd = new FormData(formReqExpert);
      const req = {
        id: generateId('rqE'),
        name: user.name,
        contact: String(fd.get('contact') || '').trim(),
        specialization: String(fd.get('specialization') || '').trim(),
        message: String(fd.get('message') || '').trim(),
        ts: Date.now()
      };
      if (!req.contact || !req.specialization || !req.message) return;
      const arr = readStore(STORAGE_KEYS.reqExpert, []);
      arr.unshift(req);
      writeStore(STORAGE_KEYS.reqExpert, arr);
      renderAdminRequests();
      formReqExpert.reset();
      alert('Expert enquiry sent.');
    });

    formReqSupply.addEventListener('submit', (e) => {
      e.preventDefault();
      const user = getCurrentUser();
      if (!user) { alert('Please login first'); return; }
      const fd = new FormData(formReqSupply);
      const req = {
        id: generateId('rqI'),
        name: user.name,
        category: String(fd.get('category') || 'Tools'),
        item: String(fd.get('item') || '').trim(),
        quantity: String(fd.get('quantity') || '').trim(),
        contact: String(fd.get('contact') || '').trim(),
        ts: Date.now()
      };
      if (!req.item || !req.quantity || !req.contact) return;
      const arr = readStore(STORAGE_KEYS.reqSupply, []);
      arr.unshift(req);
      writeStore(STORAGE_KEYS.reqSupply, arr);
      renderAdminRequests();
      formReqSupply.reset();
      alert('Supply request submitted.');
    });

    formPostProduct.addEventListener('submit', (e) => {
      e.preventDefault();
      const user = getCurrentUser();
      if (!user) { alert('Please login first'); return; }
      const fd = new FormData(formPostProduct);
      const product = {
        id: generateId('prd'),
        name: String(fd.get('name') || '').trim(),
        price: ensureNumber(fd.get('price')),
        contact: String(fd.get('contact') || '').trim(),
        sellerName: user.name,
        ts: Date.now()
      };
      if (!product.name || !product.contact) return;
      const products = readStore(STORAGE_KEYS.products, []);
      products.unshift(product);
      writeStore(STORAGE_KEYS.products, products);
      renderProducts();
      renderStats();
      formPostProduct.reset();
      alert('Product posted to market.');
    });
  }

  function initFooterYear() {
    const year = document.getElementById('year');
    if (year) year.textContent = String(new Date().getFullYear());
  }

  function init() {
    seedOnce();
    bindTabs();
    bindAuth();
    bindAdminForms();
    bindFarmerForms();

    renderExperts();
    renderProducts();
    renderSupplies();
    renderServices();
    renderAdminRequests();
    renderStats();

    applyAuthUI();
    initFooterYear();
  }

  document.addEventListener('DOMContentLoaded', init);
})();