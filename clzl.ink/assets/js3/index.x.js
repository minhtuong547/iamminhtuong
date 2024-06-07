const sf = function () {
  const t = document.createElement("link").relList;
  if (t && t.supports && t.supports("modulepreload")) return;
  for (const a of document.querySelectorAll('link[rel="modulepreload"]')) r(a);
  new MutationObserver((a) => {
    for (const i of a)
      if (i.type === "childList")
        for (const s of i.addedNodes)
          s.tagName === "LINK" && s.rel === "modulepreload" && r(s);
  }).observe(document, { childList: !0, subtree: !0 });
  function n(a) {
    const i = {};
    return (
      a.integrity && (i.integrity = a.integrity),
      a.referrerpolicy && (i.referrerPolicy = a.referrerpolicy),
      a.crossorigin === "use-credentials"
        ? (i.credentials = "include")
        : a.crossorigin === "anonymous"
        ? (i.credentials = "omit")
        : (i.credentials = "same-origin"),
      i
    );
  }
  function r(a) {
    if (a.ep) return;
    a.ep = !0;
    const i = n(a);
    fetch(a.href, i);
  }
};
sf();
function oi(e, t) {
  const n = Object.create(null),
    r = e.split(",");
  for (let a = 0; a < r.length; a++) n[r[a]] = !0;
  return t ? (a) => !!n[a.toLowerCase()] : (a) => !!n[a];
}
const of =
    "itemscope,allowfullscreen,formnovalidate,ismap,nomodule,novalidate,readonly",
  lf = oi(of);
function zo(e) {
  return !!e || e === "";
}
function li(e) {
  if (H(e)) {
    const t = {};
    for (let n = 0; n < e.length; n++) {
      const r = e[n],
        a = we(r) ? uf(r) : li(r);
      if (a) for (const i in a) t[i] = a[i];
    }
    return t;
  } else {
    if (we(e)) return e;
    if (xe(e)) return e;
  }
}
const cf = /;(?![^(]*\))/g,
  ff = /:(.+)/;
function uf(e) {
  const t = {};
  return (
    e.split(cf).forEach((n) => {
      if (n) {
        const r = n.split(ff);
        r.length > 1 && (t[r[0].trim()] = r[1].trim());
      }
    }),
    t
  );
}
function ci(e) {
  let t = "";
  if (we(e)) t = e;
  else if (H(e))
    for (let n = 0; n < e.length; n++) {
      const r = ci(e[n]);
      r && (t += r + " ");
    }
  else if (xe(e)) for (const n in e) e[n] && (t += n + " ");
  return t.trim();
}
const Z = (e) =>
    we(e)
      ? e
      : e == null
      ? ""
      : H(e) || (xe(e) && (e.toString === qo || !q(e.toString)))
      ? JSON.stringify(e, Ho, 2)
      : String(e),
  Ho = (e, t) =>
    t && t.__v_isRef
      ? Ho(e, t.value)
      : dn(t)
      ? {
          [`Map(${t.size})`]: [...t.entries()].reduce(
            (n, [r, a]) => ((n[`${r} =>`] = a), n),
            {}
          ),
        }
      : Vo(t)
      ? { [`Set(${t.size})`]: [...t.values()] }
      : xe(t) && !H(t) && !Ko(t)
      ? String(t)
      : t,
  le = {},
  un = [],
  Je = () => {},
  df = () => !1,
  hf = /^on[^a-z]/,
  jr = (e) => hf.test(e),
  fi = (e) => e.startsWith("onUpdate:"),
  ke = Object.assign,
  ui = (e, t) => {
    const n = e.indexOf(t);
    n > -1 && e.splice(n, 1);
  },
  mf = Object.prototype.hasOwnProperty,
  X = (e, t) => mf.call(e, t),
  H = Array.isArray,
  dn = (e) => Br(e) === "[object Map]",
  Vo = (e) => Br(e) === "[object Set]",
  q = (e) => typeof e == "function",
  we = (e) => typeof e == "string",
  di = (e) => typeof e == "symbol",
  xe = (e) => e !== null && typeof e == "object",
  Wo = (e) => xe(e) && q(e.then) && q(e.catch),
  qo = Object.prototype.toString,
  Br = (e) => qo.call(e),
  pf = (e) => Br(e).slice(8, -1),
  Ko = (e) => Br(e) === "[object Object]",
  hi = (e) =>
    we(e) && e !== "NaN" && e[0] !== "-" && "" + parseInt(e, 10) === e,
  dr = oi(
    ",key,ref,ref_for,ref_key,onVnodeBeforeMount,onVnodeMounted,onVnodeBeforeUpdate,onVnodeUpdated,onVnodeBeforeUnmount,onVnodeUnmounted"
  ),
  Ur = (e) => {
    const t = Object.create(null);
    return (n) => t[n] || (t[n] = e(n));
  },
  gf = /-(\w)/g,
  it = Ur((e) => e.replace(gf, (t, n) => (n ? n.toUpperCase() : ""))),
  vf = /\B([A-Z])/g,
  wn = Ur((e) => e.replace(vf, "-$1").toLowerCase()),
  zr = Ur((e) => e.charAt(0).toUpperCase() + e.slice(1)),
  fa = Ur((e) => (e ? `on${zr(e)}` : "")),
  qn = (e, t) => !Object.is(e, t),
  hr = (e, t) => {
    for (let n = 0; n < e.length; n++) e[n](t);
  },
  wr = (e, t, n) => {
    Object.defineProperty(e, t, { configurable: !0, enumerable: !1, value: n });
  },
  Er = (e) => {
    const t = parseFloat(e);
    return isNaN(t) ? e : t;
  };
let is;
const bf = () =>
  is ||
  (is =
    typeof globalThis != "undefined"
      ? globalThis
      : typeof self != "undefined"
      ? self
      : typeof window != "undefined"
      ? window
      : typeof global != "undefined"
      ? global
      : {});
let nt;
class yf {
  constructor(t = !1) {
    (this.active = !0),
      (this.effects = []),
      (this.cleanups = []),
      !t &&
        nt &&
        ((this.parent = nt),
        (this.index = (nt.scopes || (nt.scopes = [])).push(this) - 1));
  }
  run(t) {
    if (this.active) {
      const n = nt;
      try {
        return (nt = this), t();
      } finally {
        nt = n;
      }
    }
  }
  on() {
    nt = this;
  }
  off() {
    nt = this.parent;
  }
  stop(t) {
    if (this.active) {
      let n, r;
      for (n = 0, r = this.effects.length; n < r; n++) this.effects[n].stop();
      for (n = 0, r = this.cleanups.length; n < r; n++) this.cleanups[n]();
      if (this.scopes)
        for (n = 0, r = this.scopes.length; n < r; n++) this.scopes[n].stop(!0);
      if (this.parent && !t) {
        const a = this.parent.scopes.pop();
        a &&
          a !== this &&
          ((this.parent.scopes[this.index] = a), (a.index = this.index));
      }
      this.active = !1;
    }
  }
}
function _f(e, t = nt) {
  t && t.active && t.effects.push(e);
}
const mi = (e) => {
    const t = new Set(e);
    return (t.w = 0), (t.n = 0), t;
  },
  Yo = (e) => (e.w & $t) > 0,
  Go = (e) => (e.n & $t) > 0,
  xf = ({ deps: e }) => {
    if (e.length) for (let t = 0; t < e.length; t++) e[t].w |= $t;
  },
  wf = (e) => {
    const { deps: t } = e;
    if (t.length) {
      let n = 0;
      for (let r = 0; r < t.length; r++) {
        const a = t[r];
        Yo(a) && !Go(a) ? a.delete(e) : (t[n++] = a),
          (a.w &= ~$t),
          (a.n &= ~$t);
      }
      t.length = n;
    }
  },
  Sa = new WeakMap();
let Rn = 0,
  $t = 1;
const Ta = 30;
let Ke;
const qt = Symbol(""),
  Pa = Symbol("");
class pi {
  constructor(t, n = null, r) {
    (this.fn = t),
      (this.scheduler = n),
      (this.active = !0),
      (this.deps = []),
      (this.parent = void 0),
      _f(this, r);
  }
  run() {
    if (!this.active) return this.fn();
    let t = Ke,
      n = St;
    for (; t; ) {
      if (t === this) return;
      t = t.parent;
    }
    try {
      return (
        (this.parent = Ke),
        (Ke = this),
        (St = !0),
        ($t = 1 << ++Rn),
        Rn <= Ta ? xf(this) : ss(this),
        this.fn()
      );
    } finally {
      Rn <= Ta && wf(this),
        ($t = 1 << --Rn),
        (Ke = this.parent),
        (St = n),
        (this.parent = void 0),
        this.deferStop && this.stop();
    }
  }
  stop() {
    Ke === this
      ? (this.deferStop = !0)
      : this.active &&
        (ss(this), this.onStop && this.onStop(), (this.active = !1));
  }
}
function ss(e) {
  const { deps: t } = e;
  if (t.length) {
    for (let n = 0; n < t.length; n++) t[n].delete(e);
    t.length = 0;
  }
}
let St = !0;
const Xo = [];
function En() {
  Xo.push(St), (St = !1);
}
function Cn() {
  const e = Xo.pop();
  St = e === void 0 ? !0 : e;
}
function je(e, t, n) {
  if (St && Ke) {
    let r = Sa.get(e);
    r || Sa.set(e, (r = new Map()));
    let a = r.get(n);
    a || r.set(n, (a = mi())), Jo(a);
  }
}
function Jo(e, t) {
  let n = !1;
  Rn <= Ta ? Go(e) || ((e.n |= $t), (n = !Yo(e))) : (n = !e.has(Ke)),
    n && (e.add(Ke), Ke.deps.push(e));
}
function dt(e, t, n, r, a, i) {
  const s = Sa.get(e);
  if (!s) return;
  let o = [];
  if (t === "clear") o = [...s.values()];
  else if (n === "length" && H(e))
    s.forEach((l, f) => {
      (f === "length" || f >= r) && o.push(l);
    });
  else
    switch ((n !== void 0 && o.push(s.get(n)), t)) {
      case "add":
        H(e)
          ? hi(n) && o.push(s.get("length"))
          : (o.push(s.get(qt)), dn(e) && o.push(s.get(Pa)));
        break;
      case "delete":
        H(e) || (o.push(s.get(qt)), dn(e) && o.push(s.get(Pa)));
        break;
      case "set":
        dn(e) && o.push(s.get(qt));
        break;
    }
  if (o.length === 1) o[0] && $a(o[0]);
  else {
    const l = [];
    for (const f of o) f && l.push(...f);
    $a(mi(l));
  }
}
function $a(e, t) {
  const n = H(e) ? e : [...e];
  for (const r of n) r.computed && os(r);
  for (const r of n) r.computed || os(r);
}
function os(e, t) {
  (e !== Ke || e.allowRecurse) && (e.scheduler ? e.scheduler() : e.run());
}
const Ef = oi("__proto__,__v_isRef,__isVue"),
  Qo = new Set(
    Object.getOwnPropertyNames(Symbol)
      .filter((e) => e !== "arguments" && e !== "caller")
      .map((e) => Symbol[e])
      .filter(di)
  ),
  Cf = gi(),
  kf = gi(!1, !0),
  Af = gi(!0),
  ls = Of();
function Of() {
  const e = {};
  return (
    ["includes", "indexOf", "lastIndexOf"].forEach((t) => {
      e[t] = function (...n) {
        const r = ee(this);
        for (let i = 0, s = this.length; i < s; i++) je(r, "get", i + "");
        const a = r[t](...n);
        return a === -1 || a === !1 ? r[t](...n.map(ee)) : a;
      };
    }),
    ["push", "pop", "shift", "unshift", "splice"].forEach((t) => {
      e[t] = function (...n) {
        En();
        const r = ee(this)[t].apply(this, n);
        return Cn(), r;
      };
    }),
    e
  );
}
function gi(e = !1, t = !1) {
  return function (r, a, i) {
    if (a === "__v_isReactive") return !e;
    if (a === "__v_isReadonly") return e;
    if (a === "__v_isShallow") return t;
    if (a === "__v_raw" && i === (e ? (t ? Hf : rl) : t ? nl : tl).get(r))
      return r;
    const s = H(r);
    if (!e && s && X(ls, a)) return Reflect.get(ls, a, i);
    const o = Reflect.get(r, a, i);
    return (di(a) ? Qo.has(a) : Ef(a)) || (e || je(r, "get", a), t)
      ? o
      : Se(o)
      ? s && hi(a)
        ? o
        : o.value
      : xe(o)
      ? e
        ? al(o)
        : nr(o)
      : o;
  };
}
const Sf = Zo(),
  Tf = Zo(!0);
function Zo(e = !1) {
  return function (n, r, a, i) {
    let s = n[r];
    if (Kn(s) && Se(s) && !Se(a)) return !1;
    if (
      !e &&
      !Kn(a) &&
      (Ra(a) || ((a = ee(a)), (s = ee(s))), !H(n) && Se(s) && !Se(a))
    )
      return (s.value = a), !0;
    const o = H(n) && hi(r) ? Number(r) < n.length : X(n, r),
      l = Reflect.set(n, r, a, i);
    return (
      n === ee(i) && (o ? qn(a, s) && dt(n, "set", r, a) : dt(n, "add", r, a)),
      l
    );
  };
}
function Pf(e, t) {
  const n = X(e, t);
  e[t];
  const r = Reflect.deleteProperty(e, t);
  return r && n && dt(e, "delete", t, void 0), r;
}
function $f(e, t) {
  const n = Reflect.has(e, t);
  return (!di(t) || !Qo.has(t)) && je(e, "has", t), n;
}
function Rf(e) {
  return je(e, "iterate", H(e) ? "length" : qt), Reflect.ownKeys(e);
}
const el = { get: Cf, set: Sf, deleteProperty: Pf, has: $f, ownKeys: Rf },
  Nf = {
    get: Af,
    set(e, t) {
      return !0;
    },
    deleteProperty(e, t) {
      return !0;
    },
  },
  If = ke({}, el, { get: kf, set: Tf }),
  vi = (e) => e,
  Hr = (e) => Reflect.getPrototypeOf(e);
function ar(e, t, n = !1, r = !1) {
  e = e.__v_raw;
  const a = ee(e),
    i = ee(t);
  n || (t !== i && je(a, "get", t), je(a, "get", i));
  const { has: s } = Hr(a),
    o = r ? vi : n ? _i : Yn;
  if (s.call(a, t)) return o(e.get(t));
  if (s.call(a, i)) return o(e.get(i));
  e !== a && e.get(t);
}
function ir(e, t = !1) {
  const n = this.__v_raw,
    r = ee(n),
    a = ee(e);
  return (
    t || (e !== a && je(r, "has", e), je(r, "has", a)),
    e === a ? n.has(e) : n.has(e) || n.has(a)
  );
}
function sr(e, t = !1) {
  return (
    (e = e.__v_raw), !t && je(ee(e), "iterate", qt), Reflect.get(e, "size", e)
  );
}
function cs(e) {
  e = ee(e);
  const t = ee(this);
  return Hr(t).has.call(t, e) || (t.add(e), dt(t, "add", e, e)), this;
}
function fs(e, t) {
  t = ee(t);
  const n = ee(this),
    { has: r, get: a } = Hr(n);
  let i = r.call(n, e);
  i || ((e = ee(e)), (i = r.call(n, e)));
  const s = a.call(n, e);
  return (
    n.set(e, t), i ? qn(t, s) && dt(n, "set", e, t) : dt(n, "add", e, t), this
  );
}
function us(e) {
  const t = ee(this),
    { has: n, get: r } = Hr(t);
  let a = n.call(t, e);
  a || ((e = ee(e)), (a = n.call(t, e))), r && r.call(t, e);
  const i = t.delete(e);
  return a && dt(t, "delete", e, void 0), i;
}
function ds() {
  const e = ee(this),
    t = e.size !== 0,
    n = e.clear();
  return t && dt(e, "clear", void 0, void 0), n;
}
function or(e, t) {
  return function (r, a) {
    const i = this,
      s = i.__v_raw,
      o = ee(s),
      l = t ? vi : e ? _i : Yn;
    return (
      !e && je(o, "iterate", qt), s.forEach((f, c) => r.call(a, l(f), l(c), i))
    );
  };
}
function lr(e, t, n) {
  return function (...r) {
    const a = this.__v_raw,
      i = ee(a),
      s = dn(i),
      o = e === "entries" || (e === Symbol.iterator && s),
      l = e === "keys" && s,
      f = a[e](...r),
      c = n ? vi : t ? _i : Yn;
    return (
      !t && je(i, "iterate", l ? Pa : qt),
      {
        next() {
          const { value: u, done: m } = f.next();
          return m
            ? { value: u, done: m }
            : { value: o ? [c(u[0]), c(u[1])] : c(u), done: m };
        },
        [Symbol.iterator]() {
          return this;
        },
      }
    );
  };
}
function bt(e) {
  return function (...t) {
    return e === "delete" ? !1 : this;
  };
}
function Mf() {
  const e = {
      get(i) {
        return ar(this, i);
      },
      get size() {
        return sr(this);
      },
      has: ir,
      add: cs,
      set: fs,
      delete: us,
      clear: ds,
      forEach: or(!1, !1),
    },
    t = {
      get(i) {
        return ar(this, i, !1, !0);
      },
      get size() {
        return sr(this);
      },
      has: ir,
      add: cs,
      set: fs,
      delete: us,
      clear: ds,
      forEach: or(!1, !0),
    },
    n = {
      get(i) {
        return ar(this, i, !0);
      },
      get size() {
        return sr(this, !0);
      },
      has(i) {
        return ir.call(this, i, !0);
      },
      add: bt("add"),
      set: bt("set"),
      delete: bt("delete"),
      clear: bt("clear"),
      forEach: or(!0, !1),
    },
    r = {
      get(i) {
        return ar(this, i, !0, !0);
      },
      get size() {
        return sr(this, !0);
      },
      has(i) {
        return ir.call(this, i, !0);
      },
      add: bt("add"),
      set: bt("set"),
      delete: bt("delete"),
      clear: bt("clear"),
      forEach: or(!0, !0),
    };
  return (
    ["keys", "values", "entries", Symbol.iterator].forEach((i) => {
      (e[i] = lr(i, !1, !1)),
        (n[i] = lr(i, !0, !1)),
        (t[i] = lr(i, !1, !0)),
        (r[i] = lr(i, !0, !0));
    }),
    [e, n, t, r]
  );
}
const [Lf, Df, Ff, jf] = Mf();
function bi(e, t) {
  const n = t ? (e ? jf : Ff) : e ? Df : Lf;
  return (r, a, i) =>
    a === "__v_isReactive"
      ? !e
      : a === "__v_isReadonly"
      ? e
      : a === "__v_raw"
      ? r
      : Reflect.get(X(n, a) && a in r ? n : r, a, i);
}
const Bf = { get: bi(!1, !1) },
  Uf = { get: bi(!1, !0) },
  zf = { get: bi(!0, !1) },
  tl = new WeakMap(),
  nl = new WeakMap(),
  rl = new WeakMap(),
  Hf = new WeakMap();
function Vf(e) {
  switch (e) {
    case "Object":
    case "Array":
      return 1;
    case "Map":
    case "Set":
    case "WeakMap":
    case "WeakSet":
      return 2;
    default:
      return 0;
  }
}
function Wf(e) {
  return e.__v_skip || !Object.isExtensible(e) ? 0 : Vf(pf(e));
}
function nr(e) {
  return Kn(e) ? e : yi(e, !1, el, Bf, tl);
}
function qf(e) {
  return yi(e, !1, If, Uf, nl);
}
function al(e) {
  return yi(e, !0, Nf, zf, rl);
}
function yi(e, t, n, r, a) {
  if (!xe(e) || (e.__v_raw && !(t && e.__v_isReactive))) return e;
  const i = a.get(e);
  if (i) return i;
  const s = Wf(e);
  if (s === 0) return e;
  const o = new Proxy(e, s === 2 ? r : n);
  return a.set(e, o), o;
}
function hn(e) {
  return Kn(e) ? hn(e.__v_raw) : !!(e && e.__v_isReactive);
}
function Kn(e) {
  return !!(e && e.__v_isReadonly);
}
function Ra(e) {
  return !!(e && e.__v_isShallow);
}
function il(e) {
  return hn(e) || Kn(e);
}
function ee(e) {
  const t = e && e.__v_raw;
  return t ? ee(t) : e;
}
function sl(e) {
  return wr(e, "__v_skip", !0), e;
}
const Yn = (e) => (xe(e) ? nr(e) : e),
  _i = (e) => (xe(e) ? al(e) : e);
function ol(e) {
  St && Ke && ((e = ee(e)), Jo(e.dep || (e.dep = mi())));
}
function ll(e, t) {
  (e = ee(e)), e.dep && $a(e.dep);
}
function Se(e) {
  return !!(e && e.__v_isRef === !0);
}
function Kf(e) {
  return cl(e, !1);
}
function Yf(e) {
  return cl(e, !0);
}
function cl(e, t) {
  return Se(e) ? e : new Gf(e, t);
}
class Gf {
  constructor(t, n) {
    (this.__v_isShallow = n),
      (this.dep = void 0),
      (this.__v_isRef = !0),
      (this._rawValue = n ? t : ee(t)),
      (this._value = n ? t : Yn(t));
  }
  get value() {
    return ol(this), this._value;
  }
  set value(t) {
    (t = this.__v_isShallow ? t : ee(t)),
      qn(t, this._rawValue) &&
        ((this._rawValue = t),
        (this._value = this.__v_isShallow ? t : Yn(t)),
        ll(this));
  }
}
function mn(e) {
  return Se(e) ? e.value : e;
}
const Xf = {
  get: (e, t, n) => mn(Reflect.get(e, t, n)),
  set: (e, t, n, r) => {
    const a = e[t];
    return Se(a) && !Se(n) ? ((a.value = n), !0) : Reflect.set(e, t, n, r);
  },
};
function fl(e) {
  return hn(e) ? e : new Proxy(e, Xf);
}
class Jf {
  constructor(t, n, r, a) {
    (this._setter = n),
      (this.dep = void 0),
      (this.__v_isRef = !0),
      (this._dirty = !0),
      (this.effect = new pi(t, () => {
        this._dirty || ((this._dirty = !0), ll(this));
      })),
      (this.effect.computed = this),
      (this.effect.active = this._cacheable = !a),
      (this.__v_isReadonly = r);
  }
  get value() {
    const t = ee(this);
    return (
      ol(t),
      (t._dirty || !t._cacheable) &&
        ((t._dirty = !1), (t._value = t.effect.run())),
      t._value
    );
  }
  set value(t) {
    this._setter(t);
  }
}
function Qf(e, t, n = !1) {
  let r, a;
  const i = q(e);
  return (
    i ? ((r = e), (a = Je)) : ((r = e.get), (a = e.set)),
    new Jf(r, a, i || !a, n)
  );
}
function Tt(e, t, n, r) {
  let a;
  try {
    a = r ? e(...r) : e();
  } catch (i) {
    Vr(i, t, n);
  }
  return a;
}
function He(e, t, n, r) {
  if (q(e)) {
    const i = Tt(e, t, n, r);
    return (
      i &&
        Wo(i) &&
        i.catch((s) => {
          Vr(s, t, n);
        }),
      i
    );
  }
  const a = [];
  for (let i = 0; i < e.length; i++) a.push(He(e[i], t, n, r));
  return a;
}
function Vr(e, t, n, r = !0) {
  const a = t ? t.vnode : null;
  if (t) {
    let i = t.parent;
    const s = t.proxy,
      o = n;
    for (; i; ) {
      const f = i.ec;
      if (f) {
        for (let c = 0; c < f.length; c++) if (f[c](e, s, o) === !1) return;
      }
      i = i.parent;
    }
    const l = t.appContext.config.errorHandler;
    if (l) {
      Tt(l, null, 10, [e, s, o]);
      return;
    }
  }
  Zf(e, n, a, r);
}
function Zf(e, t, n, r = !0) {
  console.error(e);
}
let Cr = !1,
  Na = !1;
const Fe = [];
let ft = 0;
const Ln = [];
let Nn = null,
  an = 0;
const Dn = [];
let Et = null,
  sn = 0;
const ul = Promise.resolve();
let xi = null,
  Ia = null;
function dl(e) {
  const t = xi || ul;
  return e ? t.then(this ? e.bind(this) : e) : t;
}
function eu(e) {
  let t = ft + 1,
    n = Fe.length;
  for (; t < n; ) {
    const r = (t + n) >>> 1;
    Gn(Fe[r]) < e ? (t = r + 1) : (n = r);
  }
  return t;
}
function hl(e) {
  (!Fe.length || !Fe.includes(e, Cr && e.allowRecurse ? ft + 1 : ft)) &&
    e !== Ia &&
    (e.id == null ? Fe.push(e) : Fe.splice(eu(e.id), 0, e), ml());
}
function ml() {
  !Cr && !Na && ((Na = !0), (xi = ul.then(vl)));
}
function tu(e) {
  const t = Fe.indexOf(e);
  t > ft && Fe.splice(t, 1);
}
function pl(e, t, n, r) {
  H(e)
    ? n.push(...e)
    : (!t || !t.includes(e, e.allowRecurse ? r + 1 : r)) && n.push(e),
    ml();
}
function nu(e) {
  pl(e, Nn, Ln, an);
}
function ru(e) {
  pl(e, Et, Dn, sn);
}
function Wr(e, t = null) {
  if (Ln.length) {
    for (
      Ia = t, Nn = [...new Set(Ln)], Ln.length = 0, an = 0;
      an < Nn.length;
      an++
    )
      Nn[an]();
    (Nn = null), (an = 0), (Ia = null), Wr(e, t);
  }
}
function gl(e) {
  if ((Wr(), Dn.length)) {
    const t = [...new Set(Dn)];
    if (((Dn.length = 0), Et)) {
      Et.push(...t);
      return;
    }
    for (Et = t, Et.sort((n, r) => Gn(n) - Gn(r)), sn = 0; sn < Et.length; sn++)
      Et[sn]();
    (Et = null), (sn = 0);
  }
}
const Gn = (e) => (e.id == null ? 1 / 0 : e.id);
function vl(e) {
  (Na = !1), (Cr = !0), Wr(e), Fe.sort((n, r) => Gn(n) - Gn(r));
  const t = Je;
  try {
    for (ft = 0; ft < Fe.length; ft++) {
      const n = Fe[ft];
      n && n.active !== !1 && Tt(n, null, 14);
    }
  } finally {
    (ft = 0),
      (Fe.length = 0),
      gl(),
      (Cr = !1),
      (xi = null),
      (Fe.length || Ln.length || Dn.length) && vl(e);
  }
}
function au(e, t, ...n) {
  if (e.isUnmounted) return;
  const r = e.vnode.props || le;
  let a = n;
  const i = t.startsWith("update:"),
    s = i && t.slice(7);
  if (s && s in r) {
    const c = `${s === "modelValue" ? "model" : s}Modifiers`,
      { number: u, trim: m } = r[c] || le;
    m && (a = n.map((g) => g.trim())), u && (a = n.map(Er));
  }
  let o,
    l = r[(o = fa(t))] || r[(o = fa(it(t)))];
  !l && i && (l = r[(o = fa(wn(t)))]), l && He(l, e, 6, a);
  const f = r[o + "Once"];
  if (f) {
    if (!e.emitted) e.emitted = {};
    else if (e.emitted[o]) return;
    (e.emitted[o] = !0), He(f, e, 6, a);
  }
}
function bl(e, t, n = !1) {
  const r = t.emitsCache,
    a = r.get(e);
  if (a !== void 0) return a;
  const i = e.emits;
  let s = {},
    o = !1;
  if (!q(e)) {
    const l = (f) => {
      const c = bl(f, t, !0);
      c && ((o = !0), ke(s, c));
    };
    !n && t.mixins.length && t.mixins.forEach(l),
      e.extends && l(e.extends),
      e.mixins && e.mixins.forEach(l);
  }
  return !i && !o
    ? (r.set(e, null), null)
    : (H(i) ? i.forEach((l) => (s[l] = null)) : ke(s, i), r.set(e, s), s);
}
function qr(e, t) {
  return !e || !jr(t)
    ? !1
    : ((t = t.slice(2).replace(/Once$/, "")),
      X(e, t[0].toLowerCase() + t.slice(1)) || X(e, wn(t)) || X(e, t));
}
let Te = null,
  Kr = null;
function kr(e) {
  const t = Te;
  return (Te = e), (Kr = (e && e.type.__scopeId) || null), t;
}
function iu(e) {
  Kr = e;
}
function su() {
  Kr = null;
}
function Gt(e, t = Te, n) {
  if (!t || e._n) return e;
  const r = (...a) => {
    r._d && Es(-1);
    const i = kr(t),
      s = e(...a);
    return kr(i), r._d && Es(1), s;
  };
  return (r._n = !0), (r._c = !0), (r._d = !0), r;
}
function ua(e) {
  const {
    type: t,
    vnode: n,
    proxy: r,
    withProxy: a,
    props: i,
    propsOptions: [s],
    slots: o,
    attrs: l,
    emit: f,
    render: c,
    renderCache: u,
    data: m,
    setupState: g,
    ctx: E,
    inheritAttrs: T,
  } = e;
  let A, v;
  const y = kr(e);
  try {
    if (n.shapeFlag & 4) {
      const D = a || r;
      (A = rt(c.call(D, D, u, i, g, m, E))), (v = l);
    } else {
      const D = t;
      (A = rt(
        D.length > 1 ? D(i, { attrs: l, slots: o, emit: f }) : D(i, null)
      )),
        (v = t.props ? l : ou(l));
    }
  } catch (D) {
    (Bn.length = 0), Vr(D, e, 1), (A = ne(Ve));
  }
  let $ = A;
  if (v && T !== !1) {
    const D = Object.keys(v),
      { shapeFlag: z } = $;
    D.length && z & 7 && (s && D.some(fi) && (v = lu(v, s)), ($ = Rt($, v)));
  }
  return (
    n.dirs && (($ = Rt($)), ($.dirs = $.dirs ? $.dirs.concat(n.dirs) : n.dirs)),
    n.transition && ($.transition = n.transition),
    (A = $),
    kr(y),
    A
  );
}
const ou = (e) => {
    let t;
    for (const n in e)
      (n === "class" || n === "style" || jr(n)) && ((t || (t = {}))[n] = e[n]);
    return t;
  },
  lu = (e, t) => {
    const n = {};
    for (const r in e) (!fi(r) || !(r.slice(9) in t)) && (n[r] = e[r]);
    return n;
  };
function cu(e, t, n) {
  const { props: r, children: a, component: i } = e,
    { props: s, children: o, patchFlag: l } = t,
    f = i.emitsOptions;
  if (t.dirs || t.transition) return !0;
  if (n && l >= 0) {
    if (l & 1024) return !0;
    if (l & 16) return r ? hs(r, s, f) : !!s;
    if (l & 8) {
      const c = t.dynamicProps;
      for (let u = 0; u < c.length; u++) {
        const m = c[u];
        if (s[m] !== r[m] && !qr(f, m)) return !0;
      }
    }
  } else
    return (a || o) && (!o || !o.$stable)
      ? !0
      : r === s
      ? !1
      : r
      ? s
        ? hs(r, s, f)
        : !0
      : !!s;
  return !1;
}
function hs(e, t, n) {
  const r = Object.keys(t);
  if (r.length !== Object.keys(e).length) return !0;
  for (let a = 0; a < r.length; a++) {
    const i = r[a];
    if (t[i] !== e[i] && !qr(n, i)) return !0;
  }
  return !1;
}
function fu({ vnode: e, parent: t }, n) {
  for (; t && t.subTree === e; ) ((e = t.vnode).el = n), (t = t.parent);
}
const uu = (e) => e.__isSuspense;
function du(e, t) {
  t && t.pendingBranch
    ? H(e)
      ? t.effects.push(...e)
      : t.effects.push(e)
    : ru(e);
}
function mr(e, t) {
  if (Ce) {
    let n = Ce.provides;
    const r = Ce.parent && Ce.parent.provides;
    r === n && (n = Ce.provides = Object.create(r)), (n[e] = t);
  }
}
function Pt(e, t, n = !1) {
  const r = Ce || Te;
  if (r) {
    const a =
      r.parent == null
        ? r.vnode.appContext && r.vnode.appContext.provides
        : r.parent.provides;
    if (a && e in a) return a[e];
    if (arguments.length > 1) return n && q(t) ? t.call(r.proxy) : t;
  }
}
const ms = {};
function Fn(e, t, n) {
  return yl(e, t, n);
}
function yl(
  e,
  t,
  { immediate: n, deep: r, flush: a, onTrack: i, onTrigger: s } = le
) {
  const o = Ce;
  let l,
    f = !1,
    c = !1;
  if (
    (Se(e)
      ? ((l = () => e.value), (f = Ra(e)))
      : hn(e)
      ? ((l = () => e), (r = !0))
      : H(e)
      ? ((c = !0),
        (f = e.some((v) => hn(v) || Ra(v))),
        (l = () =>
          e.map((v) => {
            if (Se(v)) return v.value;
            if (hn(v)) return Vt(v);
            if (q(v)) return Tt(v, o, 2);
          })))
      : q(e)
      ? t
        ? (l = () => Tt(e, o, 2))
        : (l = () => {
            if (!(o && o.isUnmounted)) return u && u(), He(e, o, 3, [m]);
          })
      : (l = Je),
    t && r)
  ) {
    const v = l;
    l = () => Vt(v());
  }
  let u,
    m = (v) => {
      u = A.onStop = () => {
        Tt(v, o, 4);
      };
    };
  if (Zn)
    return (m = Je), t ? n && He(t, o, 3, [l(), c ? [] : void 0, m]) : l(), Je;
  let g = c ? [] : ms;
  const E = () => {
    if (!!A.active)
      if (t) {
        const v = A.run();
        (r || f || (c ? v.some((y, $) => qn(y, g[$])) : qn(v, g))) &&
          (u && u(), He(t, o, 3, [v, g === ms ? void 0 : g, m]), (g = v));
      } else A.run();
  };
  E.allowRecurse = !!t;
  let T;
  a === "sync"
    ? (T = E)
    : a === "post"
    ? (T = () => Ne(E, o && o.suspense))
    : (T = () => nu(E));
  const A = new pi(l, T);
  return (
    t
      ? n
        ? E()
        : (g = A.run())
      : a === "post"
      ? Ne(A.run.bind(A), o && o.suspense)
      : A.run(),
    () => {
      A.stop(), o && o.scope && ui(o.scope.effects, A);
    }
  );
}
function hu(e, t, n) {
  const r = this.proxy,
    a = we(e) ? (e.includes(".") ? _l(r, e) : () => r[e]) : e.bind(r, r);
  let i;
  q(t) ? (i = t) : ((i = t.handler), (n = t));
  const s = Ce;
  gn(this);
  const o = yl(a, i.bind(r), n);
  return s ? gn(s) : Yt(), o;
}
function _l(e, t) {
  const n = t.split(".");
  return () => {
    let r = e;
    for (let a = 0; a < n.length && r; a++) r = r[n[a]];
    return r;
  };
}
function Vt(e, t) {
  if (!xe(e) || e.__v_skip || ((t = t || new Set()), t.has(e))) return e;
  if ((t.add(e), Se(e))) Vt(e.value, t);
  else if (H(e)) for (let n = 0; n < e.length; n++) Vt(e[n], t);
  else if (Vo(e) || dn(e))
    e.forEach((n) => {
      Vt(n, t);
    });
  else if (Ko(e)) for (const n in e) Vt(e[n], t);
  return e;
}
function xl() {
  const e = {
    isMounted: !1,
    isLeaving: !1,
    isUnmounting: !1,
    leavingVNodes: new Map(),
  };
  return (
    Cl(() => {
      e.isMounted = !0;
    }),
    Al(() => {
      e.isUnmounting = !0;
    }),
    e
  );
}
const ze = [Function, Array],
  mu = {
    name: "BaseTransition",
    props: {
      mode: String,
      appear: Boolean,
      persisted: Boolean,
      onBeforeEnter: ze,
      onEnter: ze,
      onAfterEnter: ze,
      onEnterCancelled: ze,
      onBeforeLeave: ze,
      onLeave: ze,
      onAfterLeave: ze,
      onLeaveCancelled: ze,
      onBeforeAppear: ze,
      onAppear: ze,
      onAfterAppear: ze,
      onAppearCancelled: ze,
    },
    setup(e, { slots: t }) {
      const n = zl(),
        r = xl();
      let a;
      return () => {
        const i = t.default && wi(t.default(), !0);
        if (!i || !i.length) return;
        let s = i[0];
        if (i.length > 1) {
          for (const T of i)
            if (T.type !== Ve) {
              s = T;
              break;
            }
        }
        const o = ee(e),
          { mode: l } = o;
        if (r.isLeaving) return da(s);
        const f = ps(s);
        if (!f) return da(s);
        const c = Xn(f, o, r, n);
        Jn(f, c);
        const u = n.subTree,
          m = u && ps(u);
        let g = !1;
        const { getTransitionKey: E } = f.type;
        if (E) {
          const T = E();
          a === void 0 ? (a = T) : T !== a && ((a = T), (g = !0));
        }
        if (m && m.type !== Ve && (!zt(f, m) || g)) {
          const T = Xn(m, o, r, n);
          if ((Jn(m, T), l === "out-in"))
            return (
              (r.isLeaving = !0),
              (T.afterLeave = () => {
                (r.isLeaving = !1), n.update();
              }),
              da(s)
            );
          l === "in-out" &&
            f.type !== Ve &&
            (T.delayLeave = (A, v, y) => {
              const $ = wl(r, m);
              ($[String(m.key)] = m),
                (A._leaveCb = () => {
                  v(), (A._leaveCb = void 0), delete c.delayedLeave;
                }),
                (c.delayedLeave = y);
            });
        }
        return s;
      };
    },
  },
  pu = mu;
function wl(e, t) {
  const { leavingVNodes: n } = e;
  let r = n.get(t.type);
  return r || ((r = Object.create(null)), n.set(t.type, r)), r;
}
function Xn(e, t, n, r) {
  const {
      appear: a,
      mode: i,
      persisted: s = !1,
      onBeforeEnter: o,
      onEnter: l,
      onAfterEnter: f,
      onEnterCancelled: c,
      onBeforeLeave: u,
      onLeave: m,
      onAfterLeave: g,
      onLeaveCancelled: E,
      onBeforeAppear: T,
      onAppear: A,
      onAfterAppear: v,
      onAppearCancelled: y,
    } = t,
    $ = String(e.key),
    D = wl(n, e),
    z = (W, G) => {
      W && He(W, r, 9, G);
    },
    te = (W, G) => {
      const ce = G[1];
      z(W, G),
        H(W) ? W.every((_e) => _e.length <= 1) && ce() : W.length <= 1 && ce();
    },
    de = {
      mode: i,
      persisted: s,
      beforeEnter(W) {
        let G = o;
        if (!n.isMounted)
          if (a) G = T || o;
          else return;
        W._leaveCb && W._leaveCb(!0);
        const ce = D[$];
        ce && zt(e, ce) && ce.el._leaveCb && ce.el._leaveCb(), z(G, [W]);
      },
      enter(W) {
        let G = l,
          ce = f,
          _e = c;
        if (!n.isMounted)
          if (a) (G = A || l), (ce = v || f), (_e = y || c);
          else return;
        let I = !1;
        const he = (W._enterCb = (Oe) => {
          I ||
            ((I = !0),
            Oe ? z(_e, [W]) : z(ce, [W]),
            de.delayedLeave && de.delayedLeave(),
            (W._enterCb = void 0));
        });
        G ? te(G, [W, he]) : he();
      },
      leave(W, G) {
        const ce = String(e.key);
        if ((W._enterCb && W._enterCb(!0), n.isUnmounting)) return G();
        z(u, [W]);
        let _e = !1;
        const I = (W._leaveCb = (he) => {
          _e ||
            ((_e = !0),
            G(),
            he ? z(E, [W]) : z(g, [W]),
            (W._leaveCb = void 0),
            D[ce] === e && delete D[ce]);
        });
        (D[ce] = e), m ? te(m, [W, I]) : I();
      },
      clone(W) {
        return Xn(W, t, n, r);
      },
    };
  return de;
}
function da(e) {
  if (Yr(e)) return (e = Rt(e)), (e.children = null), e;
}
function ps(e) {
  return Yr(e) ? (e.children ? e.children[0] : void 0) : e;
}
function Jn(e, t) {
  e.shapeFlag & 6 && e.component
    ? Jn(e.component.subTree, t)
    : e.shapeFlag & 128
    ? ((e.ssContent.transition = t.clone(e.ssContent)),
      (e.ssFallback.transition = t.clone(e.ssFallback)))
    : (e.transition = t);
}
function wi(e, t = !1, n) {
  let r = [],
    a = 0;
  for (let i = 0; i < e.length; i++) {
    let s = e[i];
    const o = n == null ? s.key : String(n) + String(s.key != null ? s.key : i);
    s.type === ye
      ? (s.patchFlag & 128 && a++, (r = r.concat(wi(s.children, t, o))))
      : (t || s.type !== Ve) && r.push(o != null ? Rt(s, { key: o }) : s);
  }
  if (a > 1) for (let i = 0; i < r.length; i++) r[i].patchFlag = -2;
  return r;
}
function Mt(e) {
  return q(e) ? { setup: e, name: e.name } : e;
}
const jn = (e) => !!e.type.__asyncLoader,
  Yr = (e) => e.type.__isKeepAlive;
function gu(e, t) {
  El(e, "a", t);
}
function vu(e, t) {
  El(e, "da", t);
}
function El(e, t, n = Ce) {
  const r =
    e.__wdc ||
    (e.__wdc = () => {
      let a = n;
      for (; a; ) {
        if (a.isDeactivated) return;
        a = a.parent;
      }
      return e();
    });
  if ((Gr(t, r, n), n)) {
    let a = n.parent;
    for (; a && a.parent; )
      Yr(a.parent.vnode) && bu(r, t, n, a), (a = a.parent);
  }
}
function bu(e, t, n, r) {
  const a = Gr(t, e, r, !0);
  Ol(() => {
    ui(r[t], a);
  }, n);
}
function Gr(e, t, n = Ce, r = !1) {
  if (n) {
    const a = n[e] || (n[e] = []),
      i =
        t.__weh ||
        (t.__weh = (...s) => {
          if (n.isUnmounted) return;
          En(), gn(n);
          const o = He(t, n, e, s);
          return Yt(), Cn(), o;
        });
    return r ? a.unshift(i) : a.push(i), i;
  }
}
const gt =
    (e) =>
    (t, n = Ce) =>
      (!Zn || e === "sp") && Gr(e, t, n),
  yu = gt("bm"),
  Cl = gt("m"),
  _u = gt("bu"),
  kl = gt("u"),
  Al = gt("bum"),
  Ol = gt("um"),
  xu = gt("sp"),
  wu = gt("rtg"),
  Eu = gt("rtc");
function Cu(e, t = Ce) {
  Gr("ec", e, t);
}
function ku(e, t) {
  const n = Te;
  if (n === null) return e;
  const r = Jr(n) || n.proxy,
    a = e.dirs || (e.dirs = []);
  for (let i = 0; i < t.length; i++) {
    let [s, o, l, f = le] = t[i];
    q(s) && (s = { mounted: s, updated: s }),
      s.deep && Vt(o),
      a.push({
        dir: s,
        instance: r,
        value: o,
        oldValue: void 0,
        arg: l,
        modifiers: f,
      });
  }
  return e;
}
function Ft(e, t, n, r) {
  const a = e.dirs,
    i = t && t.dirs;
  for (let s = 0; s < a.length; s++) {
    const o = a[s];
    i && (o.oldValue = i[s].value);
    let l = o.dir[r];
    l && (En(), He(l, n, 8, [e.el, o, e, t]), Cn());
  }
}
const Ei = "components";
function In(e, t) {
  return Tl(Ei, e, !0, t) || e;
}
const Sl = Symbol();
function Au(e) {
  return we(e) ? Tl(Ei, e, !1) || e : e || Sl;
}
function Tl(e, t, n = !0, r = !1) {
  const a = Te || Ce;
  if (a) {
    const i = a.type;
    if (e === Ei) {
      const o = td(i, !1);
      if (o && (o === t || o === it(t) || o === zr(it(t)))) return i;
    }
    const s = gs(a[e] || i[e], t) || gs(a.appContext[e], t);
    return !s && r ? i : s;
  }
}
function gs(e, t) {
  return e && (e[t] || e[it(t)] || e[zr(it(t))]);
}
function Kt(e, t, n, r) {
  let a;
  const i = n && n[r];
  if (H(e) || we(e)) {
    a = new Array(e.length);
    for (let s = 0, o = e.length; s < o; s++)
      a[s] = t(e[s], s, void 0, i && i[s]);
  } else if (typeof e == "number") {
    a = new Array(e);
    for (let s = 0; s < e; s++) a[s] = t(s + 1, s, void 0, i && i[s]);
  } else if (xe(e))
    if (e[Symbol.iterator])
      a = Array.from(e, (s, o) => t(s, o, void 0, i && i[o]));
    else {
      const s = Object.keys(e);
      a = new Array(s.length);
      for (let o = 0, l = s.length; o < l; o++) {
        const f = s[o];
        a[o] = t(e[f], f, o, i && i[o]);
      }
    }
  else a = [];
  return n && (n[r] = a), a;
}
function Ci(e, t, n = {}, r, a) {
  if (Te.isCE || (Te.parent && jn(Te.parent) && Te.parent.isCE))
    return ne("slot", t === "default" ? null : { name: t }, r && r());
  let i = e[t];
  i && i._c && (i._d = !1), J();
  const s = i && Pl(i(n)),
    o = ut(
      ye,
      { key: n.key || `_${t}` },
      s || (r ? r() : []),
      s && e._ === 1 ? 64 : -2
    );
  return (
    !a && o.scopeId && (o.slotScopeIds = [o.scopeId + "-s"]),
    i && i._c && (i._d = !0),
    o
  );
}
function Pl(e) {
  return e.some((t) =>
    Sr(t) ? !(t.type === Ve || (t.type === ye && !Pl(t.children))) : !0
  )
    ? e
    : null;
}
const Ma = (e) => (e ? (Hl(e) ? Jr(e) || e.proxy : Ma(e.parent)) : null),
  Ar = ke(Object.create(null), {
    $: (e) => e,
    $el: (e) => e.vnode.el,
    $data: (e) => e.data,
    $props: (e) => e.props,
    $attrs: (e) => e.attrs,
    $slots: (e) => e.slots,
    $refs: (e) => e.refs,
    $parent: (e) => Ma(e.parent),
    $root: (e) => Ma(e.root),
    $emit: (e) => e.emit,
    $options: (e) => Rl(e),
    $forceUpdate: (e) => e.f || (e.f = () => hl(e.update)),
    $nextTick: (e) => e.n || (e.n = dl.bind(e.proxy)),
    $watch: (e) => hu.bind(e),
  }),
  Ou = {
    get({ _: e }, t) {
      const {
        ctx: n,
        setupState: r,
        data: a,
        props: i,
        accessCache: s,
        type: o,
        appContext: l,
      } = e;
      let f;
      if (t[0] !== "$") {
        const g = s[t];
        if (g !== void 0)
          switch (g) {
            case 1:
              return r[t];
            case 2:
              return a[t];
            case 4:
              return n[t];
            case 3:
              return i[t];
          }
        else {
          if (r !== le && X(r, t)) return (s[t] = 1), r[t];
          if (a !== le && X(a, t)) return (s[t] = 2), a[t];
          if ((f = e.propsOptions[0]) && X(f, t)) return (s[t] = 3), i[t];
          if (n !== le && X(n, t)) return (s[t] = 4), n[t];
          La && (s[t] = 0);
        }
      }
      const c = Ar[t];
      let u, m;
      if (c) return t === "$attrs" && je(e, "get", t), c(e);
      if ((u = o.__cssModules) && (u = u[t])) return u;
      if (n !== le && X(n, t)) return (s[t] = 4), n[t];
      if (((m = l.config.globalProperties), X(m, t))) return m[t];
    },
    set({ _: e }, t, n) {
      const { data: r, setupState: a, ctx: i } = e;
      return a !== le && X(a, t)
        ? ((a[t] = n), !0)
        : r !== le && X(r, t)
        ? ((r[t] = n), !0)
        : X(e.props, t) || (t[0] === "$" && t.slice(1) in e)
        ? !1
        : ((i[t] = n), !0);
    },
    has(
      {
        _: {
          data: e,
          setupState: t,
          accessCache: n,
          ctx: r,
          appContext: a,
          propsOptions: i,
        },
      },
      s
    ) {
      let o;
      return (
        !!n[s] ||
        (e !== le && X(e, s)) ||
        (t !== le && X(t, s)) ||
        ((o = i[0]) && X(o, s)) ||
        X(r, s) ||
        X(Ar, s) ||
        X(a.config.globalProperties, s)
      );
    },
    defineProperty(e, t, n) {
      return (
        n.get != null
          ? (e._.accessCache[t] = 0)
          : X(n, "value") && this.set(e, t, n.value, null),
        Reflect.defineProperty(e, t, n)
      );
    },
  };
let La = !0;
function Su(e) {
  const t = Rl(e),
    n = e.proxy,
    r = e.ctx;
  (La = !1), t.beforeCreate && vs(t.beforeCreate, e, "bc");
  const {
    data: a,
    computed: i,
    methods: s,
    watch: o,
    provide: l,
    inject: f,
    created: c,
    beforeMount: u,
    mounted: m,
    beforeUpdate: g,
    updated: E,
    activated: T,
    deactivated: A,
    beforeDestroy: v,
    beforeUnmount: y,
    destroyed: $,
    unmounted: D,
    render: z,
    renderTracked: te,
    renderTriggered: de,
    errorCaptured: W,
    serverPrefetch: G,
    expose: ce,
    inheritAttrs: _e,
    components: I,
    directives: he,
    filters: Oe,
  } = t;
  if ((f && Tu(f, r, null, e.appContext.config.unwrapInjectedRef), s))
    for (const fe in s) {
      const re = s[fe];
      q(re) && (r[fe] = re.bind(n));
    }
  if (a) {
    const fe = a.call(n, n);
    xe(fe) && (e.data = nr(fe));
  }
  if (((La = !0), i))
    for (const fe in i) {
      const re = i[fe],
        Me = q(re) ? re.bind(n, n) : q(re.get) ? re.get.bind(n, n) : Je,
        Zt = !q(re) && q(re.set) ? re.set.bind(n) : Je,
        ot = ve({ get: Me, set: Zt });
      Object.defineProperty(r, fe, {
        enumerable: !0,
        configurable: !0,
        get: () => ot.value,
        set: (Ze) => (ot.value = Ze),
      });
    }
  if (o) for (const fe in o) $l(o[fe], r, n, fe);
  if (l) {
    const fe = q(l) ? l.call(n) : l;
    Reflect.ownKeys(fe).forEach((re) => {
      mr(re, fe[re]);
    });
  }
  c && vs(c, e, "c");
  function be(fe, re) {
    H(re) ? re.forEach((Me) => fe(Me.bind(n))) : re && fe(re.bind(n));
  }
  if (
    (be(yu, u),
    be(Cl, m),
    be(_u, g),
    be(kl, E),
    be(gu, T),
    be(vu, A),
    be(Cu, W),
    be(Eu, te),
    be(wu, de),
    be(Al, y),
    be(Ol, D),
    be(xu, G),
    H(ce))
  )
    if (ce.length) {
      const fe = e.exposed || (e.exposed = {});
      ce.forEach((re) => {
        Object.defineProperty(fe, re, {
          get: () => n[re],
          set: (Me) => (n[re] = Me),
        });
      });
    } else e.exposed || (e.exposed = {});
  z && e.render === Je && (e.render = z),
    _e != null && (e.inheritAttrs = _e),
    I && (e.components = I),
    he && (e.directives = he);
}
function Tu(e, t, n = Je, r = !1) {
  H(e) && (e = Da(e));
  for (const a in e) {
    const i = e[a];
    let s;
    xe(i)
      ? "default" in i
        ? (s = Pt(i.from || a, i.default, !0))
        : (s = Pt(i.from || a))
      : (s = Pt(i)),
      Se(s) && r
        ? Object.defineProperty(t, a, {
            enumerable: !0,
            configurable: !0,
            get: () => s.value,
            set: (o) => (s.value = o),
          })
        : (t[a] = s);
  }
}
function vs(e, t, n) {
  He(H(e) ? e.map((r) => r.bind(t.proxy)) : e.bind(t.proxy), t, n);
}
function $l(e, t, n, r) {
  const a = r.includes(".") ? _l(n, r) : () => n[r];
  if (we(e)) {
    const i = t[e];
    q(i) && Fn(a, i);
  } else if (q(e)) Fn(a, e.bind(n));
  else if (xe(e))
    if (H(e)) e.forEach((i) => $l(i, t, n, r));
    else {
      const i = q(e.handler) ? e.handler.bind(n) : t[e.handler];
      q(i) && Fn(a, i, e);
    }
}
function Rl(e) {
  const t = e.type,
    { mixins: n, extends: r } = t,
    {
      mixins: a,
      optionsCache: i,
      config: { optionMergeStrategies: s },
    } = e.appContext,
    o = i.get(t);
  let l;
  return (
    o
      ? (l = o)
      : !a.length && !n && !r
      ? (l = t)
      : ((l = {}), a.length && a.forEach((f) => Or(l, f, s, !0)), Or(l, t, s)),
    i.set(t, l),
    l
  );
}
function Or(e, t, n, r = !1) {
  const { mixins: a, extends: i } = t;
  i && Or(e, i, n, !0), a && a.forEach((s) => Or(e, s, n, !0));
  for (const s in t)
    if (!(r && s === "expose")) {
      const o = Pu[s] || (n && n[s]);
      e[s] = o ? o(e[s], t[s]) : t[s];
    }
  return e;
}
const Pu = {
  data: bs,
  props: Ut,
  emits: Ut,
  methods: Ut,
  computed: Ut,
  beforeCreate: $e,
  created: $e,
  beforeMount: $e,
  mounted: $e,
  beforeUpdate: $e,
  updated: $e,
  beforeDestroy: $e,
  beforeUnmount: $e,
  destroyed: $e,
  unmounted: $e,
  activated: $e,
  deactivated: $e,
  errorCaptured: $e,
  serverPrefetch: $e,
  components: Ut,
  directives: Ut,
  watch: Ru,
  provide: bs,
  inject: $u,
};
function bs(e, t) {
  return t
    ? e
      ? function () {
          return ke(
            q(e) ? e.call(this, this) : e,
            q(t) ? t.call(this, this) : t
          );
        }
      : t
    : e;
}
function $u(e, t) {
  return Ut(Da(e), Da(t));
}
function Da(e) {
  if (H(e)) {
    const t = {};
    for (let n = 0; n < e.length; n++) t[e[n]] = e[n];
    return t;
  }
  return e;
}
function $e(e, t) {
  return e ? [...new Set([].concat(e, t))] : t;
}
function Ut(e, t) {
  return e ? ke(ke(Object.create(null), e), t) : t;
}
function Ru(e, t) {
  if (!e) return t;
  if (!t) return e;
  const n = ke(Object.create(null), e);
  for (const r in t) n[r] = $e(e[r], t[r]);
  return n;
}
function Nu(e, t, n, r = !1) {
  const a = {},
    i = {};
  wr(i, Xr, 1), (e.propsDefaults = Object.create(null)), Nl(e, t, a, i);
  for (const s in e.propsOptions[0]) s in a || (a[s] = void 0);
  n ? (e.props = r ? a : qf(a)) : e.type.props ? (e.props = a) : (e.props = i),
    (e.attrs = i);
}
function Iu(e, t, n, r) {
  const {
      props: a,
      attrs: i,
      vnode: { patchFlag: s },
    } = e,
    o = ee(a),
    [l] = e.propsOptions;
  let f = !1;
  if ((r || s > 0) && !(s & 16)) {
    if (s & 8) {
      const c = e.vnode.dynamicProps;
      for (let u = 0; u < c.length; u++) {
        let m = c[u];
        if (qr(e.emitsOptions, m)) continue;
        const g = t[m];
        if (l)
          if (X(i, m)) g !== i[m] && ((i[m] = g), (f = !0));
          else {
            const E = it(m);
            a[E] = Fa(l, o, E, g, e, !1);
          }
        else g !== i[m] && ((i[m] = g), (f = !0));
      }
    }
  } else {
    Nl(e, t, a, i) && (f = !0);
    let c;
    for (const u in o)
      (!t || (!X(t, u) && ((c = wn(u)) === u || !X(t, c)))) &&
        (l
          ? n &&
            (n[u] !== void 0 || n[c] !== void 0) &&
            (a[u] = Fa(l, o, u, void 0, e, !0))
          : delete a[u]);
    if (i !== o)
      for (const u in i) (!t || (!X(t, u) && !0)) && (delete i[u], (f = !0));
  }
  f && dt(e, "set", "$attrs");
}
function Nl(e, t, n, r) {
  const [a, i] = e.propsOptions;
  let s = !1,
    o;
  if (t)
    for (let l in t) {
      if (dr(l)) continue;
      const f = t[l];
      let c;
      a && X(a, (c = it(l)))
        ? !i || !i.includes(c)
          ? (n[c] = f)
          : ((o || (o = {}))[c] = f)
        : qr(e.emitsOptions, l) ||
          ((!(l in r) || f !== r[l]) && ((r[l] = f), (s = !0)));
    }
  if (i) {
    const l = ee(n),
      f = o || le;
    for (let c = 0; c < i.length; c++) {
      const u = i[c];
      n[u] = Fa(a, l, u, f[u], e, !X(f, u));
    }
  }
  return s;
}
function Fa(e, t, n, r, a, i) {
  const s = e[n];
  if (s != null) {
    const o = X(s, "default");
    if (o && r === void 0) {
      const l = s.default;
      if (s.type !== Function && q(l)) {
        const { propsDefaults: f } = a;
        n in f ? (r = f[n]) : (gn(a), (r = f[n] = l.call(null, t)), Yt());
      } else r = l;
    }
    s[0] &&
      (i && !o ? (r = !1) : s[1] && (r === "" || r === wn(n)) && (r = !0));
  }
  return r;
}
function Il(e, t, n = !1) {
  const r = t.propsCache,
    a = r.get(e);
  if (a) return a;
  const i = e.props,
    s = {},
    o = [];
  let l = !1;
  if (!q(e)) {
    const c = (u) => {
      l = !0;
      const [m, g] = Il(u, t, !0);
      ke(s, m), g && o.push(...g);
    };
    !n && t.mixins.length && t.mixins.forEach(c),
      e.extends && c(e.extends),
      e.mixins && e.mixins.forEach(c);
  }
  if (!i && !l) return r.set(e, un), un;
  if (H(i))
    for (let c = 0; c < i.length; c++) {
      const u = it(i[c]);
      ys(u) && (s[u] = le);
    }
  else if (i)
    for (const c in i) {
      const u = it(c);
      if (ys(u)) {
        const m = i[c],
          g = (s[u] = H(m) || q(m) ? { type: m } : m);
        if (g) {
          const E = ws(Boolean, g.type),
            T = ws(String, g.type);
          (g[0] = E > -1),
            (g[1] = T < 0 || E < T),
            (E > -1 || X(g, "default")) && o.push(u);
        }
      }
    }
  const f = [s, o];
  return r.set(e, f), f;
}
function ys(e) {
  return e[0] !== "$";
}
function _s(e) {
  const t = e && e.toString().match(/^\s*function (\w+)/);
  return t ? t[1] : e === null ? "null" : "";
}
function xs(e, t) {
  return _s(e) === _s(t);
}
function ws(e, t) {
  return H(t) ? t.findIndex((n) => xs(n, e)) : q(t) && xs(t, e) ? 0 : -1;
}
const Ml = (e) => e[0] === "_" || e === "$stable",
  ki = (e) => (H(e) ? e.map(rt) : [rt(e)]),
  Mu = (e, t, n) => {
    if (t._n) return t;
    const r = Gt((...a) => ki(t(...a)), n);
    return (r._c = !1), r;
  },
  Ll = (e, t, n) => {
    const r = e._ctx;
    for (const a in e) {
      if (Ml(a)) continue;
      const i = e[a];
      if (q(i)) t[a] = Mu(a, i, r);
      else if (i != null) {
        const s = ki(i);
        t[a] = () => s;
      }
    }
  },
  Dl = (e, t) => {
    const n = ki(t);
    e.slots.default = () => n;
  },
  Lu = (e, t) => {
    if (e.vnode.shapeFlag & 32) {
      const n = t._;
      n ? ((e.slots = ee(t)), wr(t, "_", n)) : Ll(t, (e.slots = {}));
    } else (e.slots = {}), t && Dl(e, t);
    wr(e.slots, Xr, 1);
  },
  Du = (e, t, n) => {
    const { vnode: r, slots: a } = e;
    let i = !0,
      s = le;
    if (r.shapeFlag & 32) {
      const o = t._;
      o
        ? n && o === 1
          ? (i = !1)
          : (ke(a, t), !n && o === 1 && delete a._)
        : ((i = !t.$stable), Ll(t, a)),
        (s = t);
    } else t && (Dl(e, t), (s = { default: 1 }));
    if (i) for (const o in a) !Ml(o) && !(o in s) && delete a[o];
  };
function Fl() {
  return {
    app: null,
    config: {
      isNativeTag: df,
      performance: !1,
      globalProperties: {},
      optionMergeStrategies: {},
      errorHandler: void 0,
      warnHandler: void 0,
      compilerOptions: {},
    },
    mixins: [],
    components: {},
    directives: {},
    provides: Object.create(null),
    optionsCache: new WeakMap(),
    propsCache: new WeakMap(),
    emitsCache: new WeakMap(),
  };
}
let Fu = 0;
function ju(e, t) {
  return function (r, a = null) {
    q(r) || (r = Object.assign({}, r)), a != null && !xe(a) && (a = null);
    const i = Fl(),
      s = new Set();
    let o = !1;
    const l = (i.app = {
      _uid: Fu++,
      _component: r,
      _props: a,
      _container: null,
      _context: i,
      _instance: null,
      version: rd,
      get config() {
        return i.config;
      },
      set config(f) {},
      use(f, ...c) {
        return (
          s.has(f) ||
            (f && q(f.install)
              ? (s.add(f), f.install(l, ...c))
              : q(f) && (s.add(f), f(l, ...c))),
          l
        );
      },
      mixin(f) {
        return i.mixins.includes(f) || i.mixins.push(f), l;
      },
      component(f, c) {
        return c ? ((i.components[f] = c), l) : i.components[f];
      },
      directive(f, c) {
        return c ? ((i.directives[f] = c), l) : i.directives[f];
      },
      mount(f, c, u) {
        if (!o) {
          const m = ne(r, a);
          return (
            (m.appContext = i),
            c && t ? t(m, f) : e(m, f, u),
            (o = !0),
            (l._container = f),
            (f.__vue_app__ = l),
            Jr(m.component) || m.component.proxy
          );
        }
      },
      unmount() {
        o && (e(null, l._container), delete l._container.__vue_app__);
      },
      provide(f, c) {
        return (i.provides[f] = c), l;
      },
    });
    return l;
  };
}
function ja(e, t, n, r, a = !1) {
  if (H(e)) {
    e.forEach((m, g) => ja(m, t && (H(t) ? t[g] : t), n, r, a));
    return;
  }
  if (jn(r) && !a) return;
  const i = r.shapeFlag & 4 ? Jr(r.component) || r.component.proxy : r.el,
    s = a ? null : i,
    { i: o, r: l } = e,
    f = t && t.r,
    c = o.refs === le ? (o.refs = {}) : o.refs,
    u = o.setupState;
  if (
    (f != null &&
      f !== l &&
      (we(f)
        ? ((c[f] = null), X(u, f) && (u[f] = null))
        : Se(f) && (f.value = null)),
    q(l))
  )
    Tt(l, o, 12, [s, c]);
  else {
    const m = we(l),
      g = Se(l);
    if (m || g) {
      const E = () => {
        if (e.f) {
          const T = m ? c[l] : l.value;
          a
            ? H(T) && ui(T, i)
            : H(T)
            ? T.includes(i) || T.push(i)
            : m
            ? ((c[l] = [i]), X(u, l) && (u[l] = c[l]))
            : ((l.value = [i]), e.k && (c[e.k] = l.value));
        } else
          m
            ? ((c[l] = s), X(u, l) && (u[l] = s))
            : g && ((l.value = s), e.k && (c[e.k] = s));
      };
      s ? ((E.id = -1), Ne(E, n)) : E();
    }
  }
}
const Ne = du;
function Bu(e) {
  return Uu(e);
}
function Uu(e, t) {
  const n = bf();
  n.__VUE__ = !0;
  const {
      insert: r,
      remove: a,
      patchProp: i,
      createElement: s,
      createText: o,
      createComment: l,
      setText: f,
      setElementText: c,
      parentNode: u,
      nextSibling: m,
      setScopeId: g = Je,
      cloneNode: E,
      insertStaticContent: T,
    } = e,
    A = (
      d,
      p,
      b,
      w = null,
      x = null,
      O = null,
      R = !1,
      k = null,
      S = !!p.dynamicChildren
    ) => {
      if (d === p) return;
      d && !zt(d, p) && ((w = F(d)), Ue(d, x, O, !0), (d = null)),
        p.patchFlag === -2 && ((S = !1), (p.dynamicChildren = null));
      const { type: C, ref: j, shapeFlag: M } = p;
      switch (C) {
        case Ai:
          v(d, p, b, w);
          break;
        case Ve:
          y(d, p, b, w);
          break;
        case pr:
          d == null && $(p, b, w, R);
          break;
        case ye:
          he(d, p, b, w, x, O, R, k, S);
          break;
        default:
          M & 1
            ? te(d, p, b, w, x, O, R, k, S)
            : M & 6
            ? Oe(d, p, b, w, x, O, R, k, S)
            : (M & 64 || M & 128) && C.process(d, p, b, w, x, O, R, k, S, ue);
      }
      j != null && x && ja(j, d && d.ref, O, p || d, !p);
    },
    v = (d, p, b, w) => {
      if (d == null) r((p.el = o(p.children)), b, w);
      else {
        const x = (p.el = d.el);
        p.children !== d.children && f(x, p.children);
      }
    },
    y = (d, p, b, w) => {
      d == null ? r((p.el = l(p.children || "")), b, w) : (p.el = d.el);
    },
    $ = (d, p, b, w) => {
      [d.el, d.anchor] = T(d.children, p, b, w, d.el, d.anchor);
    },
    D = ({ el: d, anchor: p }, b, w) => {
      let x;
      for (; d && d !== p; ) (x = m(d)), r(d, b, w), (d = x);
      r(p, b, w);
    },
    z = ({ el: d, anchor: p }) => {
      let b;
      for (; d && d !== p; ) (b = m(d)), a(d), (d = b);
      a(p);
    },
    te = (d, p, b, w, x, O, R, k, S) => {
      (R = R || p.type === "svg"),
        d == null ? de(p, b, w, x, O, R, k, S) : ce(d, p, x, O, R, k, S);
    },
    de = (d, p, b, w, x, O, R, k) => {
      let S, C;
      const {
        type: j,
        props: M,
        shapeFlag: B,
        transition: V,
        patchFlag: Q,
        dirs: ie,
      } = d;
      if (d.el && E !== void 0 && Q === -1) S = d.el = E(d.el);
      else {
        if (
          ((S = d.el = s(d.type, O, M && M.is, M)),
          B & 8
            ? c(S, d.children)
            : B & 16 &&
              G(d.children, S, null, w, x, O && j !== "foreignObject", R, k),
          ie && Ft(d, null, w, "created"),
          M)
        ) {
          for (const me in M)
            me !== "value" &&
              !dr(me) &&
              i(S, me, null, M[me], O, d.children, w, x, P);
          "value" in M && i(S, "value", null, M.value),
            (C = M.onVnodeBeforeMount) && tt(C, w, d);
        }
        W(S, d, d.scopeId, R, w);
      }
      ie && Ft(d, null, w, "beforeMount");
      const se = (!x || (x && !x.pendingBranch)) && V && !V.persisted;
      se && V.beforeEnter(S),
        r(S, p, b),
        ((C = M && M.onVnodeMounted) || se || ie) &&
          Ne(() => {
            C && tt(C, w, d), se && V.enter(S), ie && Ft(d, null, w, "mounted");
          }, x);
    },
    W = (d, p, b, w, x) => {
      if ((b && g(d, b), w)) for (let O = 0; O < w.length; O++) g(d, w[O]);
      if (x) {
        let O = x.subTree;
        if (p === O) {
          const R = x.vnode;
          W(d, R, R.scopeId, R.slotScopeIds, x.parent);
        }
      }
    },
    G = (d, p, b, w, x, O, R, k, S = 0) => {
      for (let C = S; C < d.length; C++) {
        const j = (d[C] = k ? kt(d[C]) : rt(d[C]));
        A(null, j, p, b, w, x, O, R, k);
      }
    },
    ce = (d, p, b, w, x, O, R) => {
      const k = (p.el = d.el);
      let { patchFlag: S, dynamicChildren: C, dirs: j } = p;
      S |= d.patchFlag & 16;
      const M = d.props || le,
        B = p.props || le;
      let V;
      b && jt(b, !1),
        (V = B.onVnodeBeforeUpdate) && tt(V, b, p, d),
        j && Ft(p, d, b, "beforeUpdate"),
        b && jt(b, !0);
      const Q = x && p.type !== "foreignObject";
      if (
        (C
          ? _e(d.dynamicChildren, C, k, b, w, Q, O)
          : R || Me(d, p, k, null, b, w, Q, O, !1),
        S > 0)
      ) {
        if (S & 16) I(k, p, M, B, b, w, x);
        else if (
          (S & 2 && M.class !== B.class && i(k, "class", null, B.class, x),
          S & 4 && i(k, "style", M.style, B.style, x),
          S & 8)
        ) {
          const ie = p.dynamicProps;
          for (let se = 0; se < ie.length; se++) {
            const me = ie[se],
              We = M[me],
              en = B[me];
            (en !== We || me === "value") &&
              i(k, me, We, en, x, d.children, b, w, P);
          }
        }
        S & 1 && d.children !== p.children && c(k, p.children);
      } else !R && C == null && I(k, p, M, B, b, w, x);
      ((V = B.onVnodeUpdated) || j) &&
        Ne(() => {
          V && tt(V, b, p, d), j && Ft(p, d, b, "updated");
        }, w);
    },
    _e = (d, p, b, w, x, O, R) => {
      for (let k = 0; k < p.length; k++) {
        const S = d[k],
          C = p[k],
          j =
            S.el && (S.type === ye || !zt(S, C) || S.shapeFlag & 70)
              ? u(S.el)
              : b;
        A(S, C, j, null, w, x, O, R, !0);
      }
    },
    I = (d, p, b, w, x, O, R) => {
      if (b !== w) {
        for (const k in w) {
          if (dr(k)) continue;
          const S = w[k],
            C = b[k];
          S !== C && k !== "value" && i(d, k, C, S, R, p.children, x, O, P);
        }
        if (b !== le)
          for (const k in b)
            !dr(k) && !(k in w) && i(d, k, b[k], null, R, p.children, x, O, P);
        "value" in w && i(d, "value", b.value, w.value);
      }
    },
    he = (d, p, b, w, x, O, R, k, S) => {
      const C = (p.el = d ? d.el : o("")),
        j = (p.anchor = d ? d.anchor : o(""));
      let { patchFlag: M, dynamicChildren: B, slotScopeIds: V } = p;
      V && (k = k ? k.concat(V) : V),
        d == null
          ? (r(C, b, w), r(j, b, w), G(p.children, b, j, x, O, R, k, S))
          : M > 0 && M & 64 && B && d.dynamicChildren
          ? (_e(d.dynamicChildren, B, b, x, O, R, k),
            (p.key != null || (x && p === x.subTree)) && jl(d, p, !0))
          : Me(d, p, b, j, x, O, R, k, S);
    },
    Oe = (d, p, b, w, x, O, R, k, S) => {
      (p.slotScopeIds = k),
        d == null
          ? p.shapeFlag & 512
            ? x.ctx.activate(p, b, w, R, S)
            : st(p, b, w, x, O, R, S)
          : be(d, p, S);
    },
    st = (d, p, b, w, x, O, R) => {
      const k = (d.component = Xu(d, w, x));
      if ((Yr(d) && (k.ctx.renderer = ue), Ju(k), k.asyncDep)) {
        if ((x && x.registerDep(k, fe), !d.el)) {
          const S = (k.subTree = ne(Ve));
          y(null, S, p, b);
        }
        return;
      }
      fe(k, d, p, b, x, O, R);
    },
    be = (d, p, b) => {
      const w = (p.component = d.component);
      if (cu(d, p, b))
        if (w.asyncDep && !w.asyncResolved) {
          re(w, p, b);
          return;
        } else (w.next = p), tu(w.update), w.update();
      else (p.el = d.el), (w.vnode = p);
    },
    fe = (d, p, b, w, x, O, R) => {
      const k = () => {
          if (d.isMounted) {
            let { next: j, bu: M, u: B, parent: V, vnode: Q } = d,
              ie = j,
              se;
            jt(d, !1),
              j ? ((j.el = Q.el), re(d, j, R)) : (j = Q),
              M && hr(M),
              (se = j.props && j.props.onVnodeBeforeUpdate) && tt(se, V, j, Q),
              jt(d, !0);
            const me = ua(d),
              We = d.subTree;
            (d.subTree = me),
              A(We, me, u(We.el), F(We), d, x, O),
              (j.el = me.el),
              ie === null && fu(d, me.el),
              B && Ne(B, x),
              (se = j.props && j.props.onVnodeUpdated) &&
                Ne(() => tt(se, V, j, Q), x);
          } else {
            let j;
            const { el: M, props: B } = p,
              { bm: V, m: Q, parent: ie } = d,
              se = jn(p);
            if (
              (jt(d, !1),
              V && hr(V),
              !se && (j = B && B.onVnodeBeforeMount) && tt(j, ie, p),
              jt(d, !0),
              M && K)
            ) {
              const me = () => {
                (d.subTree = ua(d)), K(M, d.subTree, d, x, null);
              };
              se
                ? p.type.__asyncLoader().then(() => !d.isUnmounted && me())
                : me();
            } else {
              const me = (d.subTree = ua(d));
              A(null, me, b, w, d, x, O), (p.el = me.el);
            }
            if ((Q && Ne(Q, x), !se && (j = B && B.onVnodeMounted))) {
              const me = p;
              Ne(() => tt(j, ie, me), x);
            }
            (p.shapeFlag & 256 ||
              (ie && jn(ie.vnode) && ie.vnode.shapeFlag & 256)) &&
              d.a &&
              Ne(d.a, x),
              (d.isMounted = !0),
              (p = b = w = null);
          }
        },
        S = (d.effect = new pi(k, () => hl(C), d.scope)),
        C = (d.update = () => S.run());
      (C.id = d.uid), jt(d, !0), C();
    },
    re = (d, p, b) => {
      p.component = d;
      const w = d.vnode.props;
      (d.vnode = p),
        (d.next = null),
        Iu(d, p.props, w, b),
        Du(d, p.children, b),
        En(),
        Wr(void 0, d.update),
        Cn();
    },
    Me = (d, p, b, w, x, O, R, k, S = !1) => {
      const C = d && d.children,
        j = d ? d.shapeFlag : 0,
        M = p.children,
        { patchFlag: B, shapeFlag: V } = p;
      if (B > 0) {
        if (B & 128) {
          ot(C, M, b, w, x, O, R, k, S);
          return;
        } else if (B & 256) {
          Zt(C, M, b, w, x, O, R, k, S);
          return;
        }
      }
      V & 8
        ? (j & 16 && P(C, x, O), M !== C && c(b, M))
        : j & 16
        ? V & 16
          ? ot(C, M, b, w, x, O, R, k, S)
          : P(C, x, O, !0)
        : (j & 8 && c(b, ""), V & 16 && G(M, b, w, x, O, R, k, S));
    },
    Zt = (d, p, b, w, x, O, R, k, S) => {
      (d = d || un), (p = p || un);
      const C = d.length,
        j = p.length,
        M = Math.min(C, j);
      let B;
      for (B = 0; B < M; B++) {
        const V = (p[B] = S ? kt(p[B]) : rt(p[B]));
        A(d[B], V, b, null, x, O, R, k, S);
      }
      C > j ? P(d, x, O, !0, !1, M) : G(p, b, w, x, O, R, k, S, M);
    },
    ot = (d, p, b, w, x, O, R, k, S) => {
      let C = 0;
      const j = p.length;
      let M = d.length - 1,
        B = j - 1;
      for (; C <= M && C <= B; ) {
        const V = d[C],
          Q = (p[C] = S ? kt(p[C]) : rt(p[C]));
        if (zt(V, Q)) A(V, Q, b, null, x, O, R, k, S);
        else break;
        C++;
      }
      for (; C <= M && C <= B; ) {
        const V = d[M],
          Q = (p[B] = S ? kt(p[B]) : rt(p[B]));
        if (zt(V, Q)) A(V, Q, b, null, x, O, R, k, S);
        else break;
        M--, B--;
      }
      if (C > M) {
        if (C <= B) {
          const V = B + 1,
            Q = V < j ? p[V].el : w;
          for (; C <= B; )
            A(null, (p[C] = S ? kt(p[C]) : rt(p[C])), b, Q, x, O, R, k, S), C++;
        }
      } else if (C > B) for (; C <= M; ) Ue(d[C], x, O, !0), C++;
      else {
        const V = C,
          Q = C,
          ie = new Map();
        for (C = Q; C <= B; C++) {
          const Le = (p[C] = S ? kt(p[C]) : rt(p[C]));
          Le.key != null && ie.set(Le.key, C);
        }
        let se,
          me = 0;
        const We = B - Q + 1;
        let en = !1,
          ns = 0;
        const Sn = new Array(We);
        for (C = 0; C < We; C++) Sn[C] = 0;
        for (C = V; C <= M; C++) {
          const Le = d[C];
          if (me >= We) {
            Ue(Le, x, O, !0);
            continue;
          }
          let et;
          if (Le.key != null) et = ie.get(Le.key);
          else
            for (se = Q; se <= B; se++)
              if (Sn[se - Q] === 0 && zt(Le, p[se])) {
                et = se;
                break;
              }
          et === void 0
            ? Ue(Le, x, O, !0)
            : ((Sn[et - Q] = C + 1),
              et >= ns ? (ns = et) : (en = !0),
              A(Le, p[et], b, null, x, O, R, k, S),
              me++);
        }
        const rs = en ? zu(Sn) : un;
        for (se = rs.length - 1, C = We - 1; C >= 0; C--) {
          const Le = Q + C,
            et = p[Le],
            as = Le + 1 < j ? p[Le + 1].el : w;
          Sn[C] === 0
            ? A(null, et, b, as, x, O, R, k, S)
            : en && (se < 0 || C !== rs[se] ? Ze(et, b, as, 2) : se--);
        }
      }
    },
    Ze = (d, p, b, w, x = null) => {
      const { el: O, type: R, transition: k, children: S, shapeFlag: C } = d;
      if (C & 6) {
        Ze(d.component.subTree, p, b, w);
        return;
      }
      if (C & 128) {
        d.suspense.move(p, b, w);
        return;
      }
      if (C & 64) {
        R.move(d, p, b, ue);
        return;
      }
      if (R === ye) {
        r(O, p, b);
        for (let M = 0; M < S.length; M++) Ze(S[M], p, b, w);
        r(d.anchor, p, b);
        return;
      }
      if (R === pr) {
        D(d, p, b);
        return;
      }
      if (w !== 2 && C & 1 && k)
        if (w === 0) k.beforeEnter(O), r(O, p, b), Ne(() => k.enter(O), x);
        else {
          const { leave: M, delayLeave: B, afterLeave: V } = k,
            Q = () => r(O, p, b),
            ie = () => {
              M(O, () => {
                Q(), V && V();
              });
            };
          B ? B(O, Q, ie) : ie();
        }
      else r(O, p, b);
    },
    Ue = (d, p, b, w = !1, x = !1) => {
      const {
        type: O,
        props: R,
        ref: k,
        children: S,
        dynamicChildren: C,
        shapeFlag: j,
        patchFlag: M,
        dirs: B,
      } = d;
      if ((k != null && ja(k, null, b, d, !0), j & 256)) {
        p.ctx.deactivate(d);
        return;
      }
      const V = j & 1 && B,
        Q = !jn(d);
      let ie;
      if ((Q && (ie = R && R.onVnodeBeforeUnmount) && tt(ie, p, d), j & 6))
        L(d.component, b, w);
      else {
        if (j & 128) {
          d.suspense.unmount(b, w);
          return;
        }
        V && Ft(d, null, p, "beforeUnmount"),
          j & 64
            ? d.type.remove(d, p, b, x, ue, w)
            : C && (O !== ye || (M > 0 && M & 64))
            ? P(C, p, b, !1, !0)
            : ((O === ye && M & 384) || (!x && j & 16)) && P(S, p, b),
          w && On(d);
      }
      ((Q && (ie = R && R.onVnodeUnmounted)) || V) &&
        Ne(() => {
          ie && tt(ie, p, d), V && Ft(d, null, p, "unmounted");
        }, b);
    },
    On = (d) => {
      const { type: p, el: b, anchor: w, transition: x } = d;
      if (p === ye) {
        _(b, w);
        return;
      }
      if (p === pr) {
        z(d);
        return;
      }
      const O = () => {
        a(b), x && !x.persisted && x.afterLeave && x.afterLeave();
      };
      if (d.shapeFlag & 1 && x && !x.persisted) {
        const { leave: R, delayLeave: k } = x,
          S = () => R(b, O);
        k ? k(d.el, O, S) : S();
      } else O();
    },
    _ = (d, p) => {
      let b;
      for (; d !== p; ) (b = m(d)), a(d), (d = b);
      a(p);
    },
    L = (d, p, b) => {
      const { bum: w, scope: x, update: O, subTree: R, um: k } = d;
      w && hr(w),
        x.stop(),
        O && ((O.active = !1), Ue(R, d, p, b)),
        k && Ne(k, p),
        Ne(() => {
          d.isUnmounted = !0;
        }, p),
        p &&
          p.pendingBranch &&
          !p.isUnmounted &&
          d.asyncDep &&
          !d.asyncResolved &&
          d.suspenseId === p.pendingId &&
          (p.deps--, p.deps === 0 && p.resolve());
    },
    P = (d, p, b, w = !1, x = !1, O = 0) => {
      for (let R = O; R < d.length; R++) Ue(d[R], p, b, w, x);
    },
    F = (d) =>
      d.shapeFlag & 6
        ? F(d.component.subTree)
        : d.shapeFlag & 128
        ? d.suspense.next()
        : m(d.anchor || d.el),
    ae = (d, p, b) => {
      d == null
        ? p._vnode && Ue(p._vnode, null, null, !0)
        : A(p._vnode || null, d, p, null, null, null, b),
        gl(),
        (p._vnode = d);
    },
    ue = {
      p: A,
      um: Ue,
      m: Ze,
      r: On,
      mt: st,
      mc: G,
      pc: Me,
      pbc: _e,
      n: F,
      o: e,
    };
  let Y, K;
  return (
    t && ([Y, K] = t(ue)), { render: ae, hydrate: Y, createApp: ju(ae, Y) }
  );
}
function jt({ effect: e, update: t }, n) {
  e.allowRecurse = t.allowRecurse = n;
}
function jl(e, t, n = !1) {
  const r = e.children,
    a = t.children;
  if (H(r) && H(a))
    for (let i = 0; i < r.length; i++) {
      const s = r[i];
      let o = a[i];
      o.shapeFlag & 1 &&
        !o.dynamicChildren &&
        ((o.patchFlag <= 0 || o.patchFlag === 32) &&
          ((o = a[i] = kt(a[i])), (o.el = s.el)),
        n || jl(s, o));
    }
}
function zu(e) {
  const t = e.slice(),
    n = [0];
  let r, a, i, s, o;
  const l = e.length;
  for (r = 0; r < l; r++) {
    const f = e[r];
    if (f !== 0) {
      if (((a = n[n.length - 1]), e[a] < f)) {
        (t[r] = a), n.push(r);
        continue;
      }
      for (i = 0, s = n.length - 1; i < s; )
        (o = (i + s) >> 1), e[n[o]] < f ? (i = o + 1) : (s = o);
      f < e[n[i]] && (i > 0 && (t[r] = n[i - 1]), (n[i] = r));
    }
  }
  for (i = n.length, s = n[i - 1]; i-- > 0; ) (n[i] = s), (s = t[s]);
  return n;
}
const Hu = (e) => e.__isTeleport,
  ye = Symbol(void 0),
  Ai = Symbol(void 0),
  Ve = Symbol(void 0),
  pr = Symbol(void 0),
  Bn = [];
let Ge = null;
function J(e = !1) {
  Bn.push((Ge = e ? null : []));
}
function Vu() {
  Bn.pop(), (Ge = Bn[Bn.length - 1] || null);
}
let Qn = 1;
function Es(e) {
  Qn += e;
}
function Bl(e) {
  return (
    (e.dynamicChildren = Qn > 0 ? Ge || un : null),
    Vu(),
    Qn > 0 && Ge && Ge.push(e),
    e
  );
}
function pe(e, t, n, r, a, i) {
  return Bl(h(e, t, n, r, a, i, !0));
}
function ut(e, t, n, r, a) {
  return Bl(ne(e, t, n, r, a, !0));
}
function Sr(e) {
  return e ? e.__v_isVNode === !0 : !1;
}
function zt(e, t) {
  return e.type === t.type && e.key === t.key;
}
const Xr = "__vInternal",
  Ul = ({ key: e }) => (e != null ? e : null),
  gr = ({ ref: e, ref_key: t, ref_for: n }) =>
    e != null
      ? we(e) || Se(e) || q(e)
        ? { i: Te, r: e, k: t, f: !!n }
        : e
      : null;
function h(
  e,
  t = null,
  n = null,
  r = 0,
  a = null,
  i = e === ye ? 0 : 1,
  s = !1,
  o = !1
) {
  const l = {
    __v_isVNode: !0,
    __v_skip: !0,
    type: e,
    props: t,
    key: t && Ul(t),
    ref: t && gr(t),
    scopeId: Kr,
    slotScopeIds: null,
    children: n,
    component: null,
    suspense: null,
    ssContent: null,
    ssFallback: null,
    dirs: null,
    transition: null,
    el: null,
    anchor: null,
    target: null,
    targetAnchor: null,
    staticCount: 0,
    shapeFlag: i,
    patchFlag: r,
    dynamicProps: a,
    dynamicChildren: null,
    appContext: null,
  };
  return (
    o
      ? (Si(l, n), i & 128 && e.normalize(l))
      : n && (l.shapeFlag |= we(n) ? 8 : 16),
    Qn > 0 &&
      !s &&
      Ge &&
      (l.patchFlag > 0 || i & 6) &&
      l.patchFlag !== 32 &&
      Ge.push(l),
    l
  );
}
const ne = Wu;
function Wu(e, t = null, n = null, r = 0, a = null, i = !1) {
  if (((!e || e === Sl) && (e = Ve), Sr(e))) {
    const o = Rt(e, t, !0);
    return (
      n && Si(o, n),
      Qn > 0 &&
        !i &&
        Ge &&
        (o.shapeFlag & 6 ? (Ge[Ge.indexOf(e)] = o) : Ge.push(o)),
      (o.patchFlag |= -2),
      o
    );
  }
  if ((nd(e) && (e = e.__vccOpts), t)) {
    t = qu(t);
    let { class: o, style: l } = t;
    o && !we(o) && (t.class = ci(o)),
      xe(l) && (il(l) && !H(l) && (l = ke({}, l)), (t.style = li(l)));
  }
  const s = we(e) ? 1 : uu(e) ? 128 : Hu(e) ? 64 : xe(e) ? 4 : q(e) ? 2 : 0;
  return h(e, t, n, r, a, s, i, !0);
}
function qu(e) {
  return e ? (il(e) || Xr in e ? ke({}, e) : e) : null;
}
function Rt(e, t, n = !1) {
  const { props: r, ref: a, patchFlag: i, children: s } = e,
    o = t ? Ku(r || {}, t) : r;
  return {
    __v_isVNode: !0,
    __v_skip: !0,
    type: e.type,
    props: o,
    key: o && Ul(o),
    ref:
      t && t.ref ? (n && a ? (H(a) ? a.concat(gr(t)) : [a, gr(t)]) : gr(t)) : a,
    scopeId: e.scopeId,
    slotScopeIds: e.slotScopeIds,
    children: s,
    target: e.target,
    targetAnchor: e.targetAnchor,
    staticCount: e.staticCount,
    shapeFlag: e.shapeFlag,
    patchFlag: t && e.type !== ye ? (i === -1 ? 16 : i | 16) : i,
    dynamicProps: e.dynamicProps,
    dynamicChildren: e.dynamicChildren,
    appContext: e.appContext,
    dirs: e.dirs,
    transition: e.transition,
    component: e.component,
    suspense: e.suspense,
    ssContent: e.ssContent && Rt(e.ssContent),
    ssFallback: e.ssFallback && Rt(e.ssFallback),
    el: e.el,
    anchor: e.anchor,
  };
}
function Pe(e = " ", t = 0) {
  return ne(Ai, null, e, t);
}
function Oi(e, t) {
  const n = ne(pr, null, e);
  return (n.staticCount = t), n;
}
function Tr(e = "", t = !1) {
  return t ? (J(), ut(Ve, null, e)) : ne(Ve, null, e);
}
function rt(e) {
  return e == null || typeof e == "boolean"
    ? ne(Ve)
    : H(e)
    ? ne(ye, null, e.slice())
    : typeof e == "object"
    ? kt(e)
    : ne(Ai, null, String(e));
}
function kt(e) {
  return e.el === null || e.memo ? e : Rt(e);
}
function Si(e, t) {
  let n = 0;
  const { shapeFlag: r } = e;
  if (t == null) t = null;
  else if (H(t)) n = 16;
  else if (typeof t == "object")
    if (r & 65) {
      const a = t.default;
      a && (a._c && (a._d = !1), Si(e, a()), a._c && (a._d = !0));
      return;
    } else {
      n = 32;
      const a = t._;
      !a && !(Xr in t)
        ? (t._ctx = Te)
        : a === 3 &&
          Te &&
          (Te.slots._ === 1 ? (t._ = 1) : ((t._ = 2), (e.patchFlag |= 1024)));
    }
  else
    q(t)
      ? ((t = { default: t, _ctx: Te }), (n = 32))
      : ((t = String(t)), r & 64 ? ((n = 16), (t = [Pe(t)])) : (n = 8));
  (e.children = t), (e.shapeFlag |= n);
}
function Ku(...e) {
  const t = {};
  for (let n = 0; n < e.length; n++) {
    const r = e[n];
    for (const a in r)
      if (a === "class")
        t.class !== r.class && (t.class = ci([t.class, r.class]));
      else if (a === "style") t.style = li([t.style, r.style]);
      else if (jr(a)) {
        const i = t[a],
          s = r[a];
        s &&
          i !== s &&
          !(H(i) && i.includes(s)) &&
          (t[a] = i ? [].concat(i, s) : s);
      } else a !== "" && (t[a] = r[a]);
  }
  return t;
}
function tt(e, t, n, r = null) {
  He(e, t, 7, [n, r]);
}
const Yu = Fl();
let Gu = 0;
function Xu(e, t, n) {
  const r = e.type,
    a = (t ? t.appContext : e.appContext) || Yu,
    i = {
      uid: Gu++,
      vnode: e,
      type: r,
      parent: t,
      appContext: a,
      root: null,
      next: null,
      subTree: null,
      effect: null,
      update: null,
      scope: new yf(!0),
      render: null,
      proxy: null,
      exposed: null,
      exposeProxy: null,
      withProxy: null,
      provides: t ? t.provides : Object.create(a.provides),
      accessCache: null,
      renderCache: [],
      components: null,
      directives: null,
      propsOptions: Il(r, a),
      emitsOptions: bl(r, a),
      emit: null,
      emitted: null,
      propsDefaults: le,
      inheritAttrs: r.inheritAttrs,
      ctx: le,
      data: le,
      props: le,
      attrs: le,
      slots: le,
      refs: le,
      setupState: le,
      setupContext: null,
      suspense: n,
      suspenseId: n ? n.pendingId : 0,
      asyncDep: null,
      asyncResolved: !1,
      isMounted: !1,
      isUnmounted: !1,
      isDeactivated: !1,
      bc: null,
      c: null,
      bm: null,
      m: null,
      bu: null,
      u: null,
      um: null,
      bum: null,
      da: null,
      a: null,
      rtg: null,
      rtc: null,
      ec: null,
      sp: null,
    };
  return (
    (i.ctx = { _: i }),
    (i.root = t ? t.root : i),
    (i.emit = au.bind(null, i)),
    e.ce && e.ce(i),
    i
  );
}
let Ce = null;
const zl = () => Ce || Te,
  gn = (e) => {
    (Ce = e), e.scope.on();
  },
  Yt = () => {
    Ce && Ce.scope.off(), (Ce = null);
  };
function Hl(e) {
  return e.vnode.shapeFlag & 4;
}
let Zn = !1;
function Ju(e, t = !1) {
  Zn = t;
  const { props: n, children: r } = e.vnode,
    a = Hl(e);
  Nu(e, n, a, t), Lu(e, r);
  const i = a ? Qu(e, t) : void 0;
  return (Zn = !1), i;
}
function Qu(e, t) {
  const n = e.type;
  (e.accessCache = Object.create(null)), (e.proxy = sl(new Proxy(e.ctx, Ou)));
  const { setup: r } = n;
  if (r) {
    const a = (e.setupContext = r.length > 1 ? ed(e) : null);
    gn(e), En();
    const i = Tt(r, e, 0, [e.props, a]);
    if ((Cn(), Yt(), Wo(i))) {
      if ((i.then(Yt, Yt), t))
        return i
          .then((s) => {
            Cs(e, s, t);
          })
          .catch((s) => {
            Vr(s, e, 0);
          });
      e.asyncDep = i;
    } else Cs(e, i, t);
  } else Vl(e, t);
}
function Cs(e, t, n) {
  q(t)
    ? e.type.__ssrInlineRender
      ? (e.ssrRender = t)
      : (e.render = t)
    : xe(t) && (e.setupState = fl(t)),
    Vl(e, n);
}
let ks;
function Vl(e, t, n) {
  const r = e.type;
  if (!e.render) {
    if (!t && ks && !r.render) {
      const a = r.template;
      if (a) {
        const { isCustomElement: i, compilerOptions: s } = e.appContext.config,
          { delimiters: o, compilerOptions: l } = r,
          f = ke(ke({ isCustomElement: i, delimiters: o }, s), l);
        r.render = ks(a, f);
      }
    }
    e.render = r.render || Je;
  }
  gn(e), En(), Su(e), Cn(), Yt();
}
function Zu(e) {
  return new Proxy(e.attrs, {
    get(t, n) {
      return je(e, "get", "$attrs"), t[n];
    },
  });
}
function ed(e) {
  const t = (r) => {
    e.exposed = r || {};
  };
  let n;
  return {
    get attrs() {
      return n || (n = Zu(e));
    },
    slots: e.slots,
    emit: e.emit,
    expose: t,
  };
}
function Jr(e) {
  if (e.exposed)
    return (
      e.exposeProxy ||
      (e.exposeProxy = new Proxy(fl(sl(e.exposed)), {
        get(t, n) {
          if (n in t) return t[n];
          if (n in Ar) return Ar[n](e);
        },
      }))
    );
}
function td(e, t = !0) {
  return q(e) ? e.displayName || e.name : e.name || (t && e.__name);
}
function nd(e) {
  return q(e) && "__vccOpts" in e;
}
const ve = (e, t) => Qf(e, t, Zn);
function Qr(e, t, n) {
  const r = arguments.length;
  return r === 2
    ? xe(t) && !H(t)
      ? Sr(t)
        ? ne(e, null, [t])
        : ne(e, t)
      : ne(e, null, t)
    : (r > 3
        ? (n = Array.prototype.slice.call(arguments, 2))
        : r === 3 && Sr(n) && (n = [n]),
      ne(e, t, n));
}
const rd = "3.2.37",
  ad = "http://www.w3.org/2000/svg",
  Ht = typeof document != "undefined" ? document : null,
  As = Ht && Ht.createElement("template"),
  id = {
    insert: (e, t, n) => {
      t.insertBefore(e, n || null);
    },
    remove: (e) => {
      const t = e.parentNode;
      t && t.removeChild(e);
    },
    createElement: (e, t, n, r) => {
      const a = t
        ? Ht.createElementNS(ad, e)
        : Ht.createElement(e, n ? { is: n } : void 0);
      return (
        e === "select" &&
          r &&
          r.multiple != null &&
          a.setAttribute("multiple", r.multiple),
        a
      );
    },
    createText: (e) => Ht.createTextNode(e),
    createComment: (e) => Ht.createComment(e),
    setText: (e, t) => {
      e.nodeValue = t;
    },
    setElementText: (e, t) => {
      e.textContent = t;
    },
    parentNode: (e) => e.parentNode,
    nextSibling: (e) => e.nextSibling,
    querySelector: (e) => Ht.querySelector(e),
    setScopeId(e, t) {
      e.setAttribute(t, "");
    },
    cloneNode(e) {
      const t = e.cloneNode(!0);
      return "_value" in e && (t._value = e._value), t;
    },
    insertStaticContent(e, t, n, r, a, i) {
      const s = n ? n.previousSibling : t.lastChild;
      if (a && (a === i || a.nextSibling))
        for (
          ;
          t.insertBefore(a.cloneNode(!0), n),
            !(a === i || !(a = a.nextSibling));

        );
      else {
        As.innerHTML = r ? `<svg>${e}</svg>` : e;
        const o = As.content;
        if (r) {
          const l = o.firstChild;
          for (; l.firstChild; ) o.appendChild(l.firstChild);
          o.removeChild(l);
        }
        t.insertBefore(o, n);
      }
      return [
        s ? s.nextSibling : t.firstChild,
        n ? n.previousSibling : t.lastChild,
      ];
    },
  };
function sd(e, t, n) {
  const r = e._vtc;
  r && (t = (t ? [t, ...r] : [...r]).join(" ")),
    t == null
      ? e.removeAttribute("class")
      : n
      ? e.setAttribute("class", t)
      : (e.className = t);
}
function od(e, t, n) {
  const r = e.style,
    a = we(n);
  if (n && !a) {
    for (const i in n) Ba(r, i, n[i]);
    if (t && !we(t)) for (const i in t) n[i] == null && Ba(r, i, "");
  } else {
    const i = r.display;
    a ? t !== n && (r.cssText = n) : t && e.removeAttribute("style"),
      "_vod" in e && (r.display = i);
  }
}
const Os = /\s*!important$/;
function Ba(e, t, n) {
  if (H(n)) n.forEach((r) => Ba(e, t, r));
  else if ((n == null && (n = ""), t.startsWith("--"))) e.setProperty(t, n);
  else {
    const r = ld(e, t);
    Os.test(n)
      ? e.setProperty(wn(r), n.replace(Os, ""), "important")
      : (e[r] = n);
  }
}
const Ss = ["Webkit", "Moz", "ms"],
  ha = {};
function ld(e, t) {
  const n = ha[t];
  if (n) return n;
  let r = it(t);
  if (r !== "filter" && r in e) return (ha[t] = r);
  r = zr(r);
  for (let a = 0; a < Ss.length; a++) {
    const i = Ss[a] + r;
    if (i in e) return (ha[t] = i);
  }
  return t;
}
const Ts = "http://www.w3.org/1999/xlink";
function cd(e, t, n, r, a) {
  if (r && t.startsWith("xlink:"))
    n == null
      ? e.removeAttributeNS(Ts, t.slice(6, t.length))
      : e.setAttributeNS(Ts, t, n);
  else {
    const i = lf(t);
    n == null || (i && !zo(n))
      ? e.removeAttribute(t)
      : e.setAttribute(t, i ? "" : n);
  }
}
function fd(e, t, n, r, a, i, s) {
  if (t === "innerHTML" || t === "textContent") {
    r && s(r, a, i), (e[t] = n == null ? "" : n);
    return;
  }
  if (t === "value" && e.tagName !== "PROGRESS" && !e.tagName.includes("-")) {
    e._value = n;
    const l = n == null ? "" : n;
    (e.value !== l || e.tagName === "OPTION") && (e.value = l),
      n == null && e.removeAttribute(t);
    return;
  }
  let o = !1;
  if (n === "" || n == null) {
    const l = typeof e[t];
    l === "boolean"
      ? (n = zo(n))
      : n == null && l === "string"
      ? ((n = ""), (o = !0))
      : l === "number" && ((n = 0), (o = !0));
  }
  try {
    e[t] = n;
  } catch {}
  o && e.removeAttribute(t);
}
const [Wl, ud] = (() => {
  let e = Date.now,
    t = !1;
  if (typeof window != "undefined") {
    Date.now() > document.createEvent("Event").timeStamp &&
      (e = performance.now.bind(performance));
    const n = navigator.userAgent.match(/firefox\/(\d+)/i);
    t = !!(n && Number(n[1]) <= 53);
  }
  return [e, t];
})();
let Ua = 0;
const dd = Promise.resolve(),
  hd = () => {
    Ua = 0;
  },
  md = () => Ua || (dd.then(hd), (Ua = Wl()));
function on(e, t, n, r) {
  e.addEventListener(t, n, r);
}
function pd(e, t, n, r) {
  e.removeEventListener(t, n, r);
}
function gd(e, t, n, r, a = null) {
  const i = e._vei || (e._vei = {}),
    s = i[t];
  if (r && s) s.value = r;
  else {
    const [o, l] = vd(t);
    if (r) {
      const f = (i[t] = bd(r, a));
      on(e, o, f, l);
    } else s && (pd(e, o, s, l), (i[t] = void 0));
  }
}
const Ps = /(?:Once|Passive|Capture)$/;
function vd(e) {
  let t;
  if (Ps.test(e)) {
    t = {};
    let n;
    for (; (n = e.match(Ps)); )
      (e = e.slice(0, e.length - n[0].length)), (t[n[0].toLowerCase()] = !0);
  }
  return [wn(e.slice(2)), t];
}
function bd(e, t) {
  const n = (r) => {
    const a = r.timeStamp || Wl();
    (ud || a >= n.attached - 1) && He(yd(r, n.value), t, 5, [r]);
  };
  return (n.value = e), (n.attached = md()), n;
}
function yd(e, t) {
  if (H(t)) {
    const n = e.stopImmediatePropagation;
    return (
      (e.stopImmediatePropagation = () => {
        n.call(e), (e._stopped = !0);
      }),
      t.map((r) => (a) => !a._stopped && r && r(a))
    );
  } else return t;
}
const $s = /^on[a-z]/,
  _d = (e, t, n, r, a = !1, i, s, o, l) => {
    t === "class"
      ? sd(e, r, a)
      : t === "style"
      ? od(e, n, r)
      : jr(t)
      ? fi(t) || gd(e, t, n, r, s)
      : (
          t[0] === "."
            ? ((t = t.slice(1)), !0)
            : t[0] === "^"
            ? ((t = t.slice(1)), !1)
            : xd(e, t, r, a)
        )
      ? fd(e, t, r, i, s, o, l)
      : (t === "true-value"
          ? (e._trueValue = r)
          : t === "false-value" && (e._falseValue = r),
        cd(e, t, r, a));
  };
function xd(e, t, n, r) {
  return r
    ? !!(
        t === "innerHTML" ||
        t === "textContent" ||
        (t in e && $s.test(t) && q(n))
      )
    : t === "spellcheck" ||
      t === "draggable" ||
      t === "translate" ||
      t === "form" ||
      (t === "list" && e.tagName === "INPUT") ||
      (t === "type" && e.tagName === "TEXTAREA") ||
      ($s.test(t) && we(n))
    ? !1
    : t in e;
}
const yt = "transition",
  Tn = "animation",
  ql = {
    name: String,
    type: String,
    css: { type: Boolean, default: !0 },
    duration: [String, Number, Object],
    enterFromClass: String,
    enterActiveClass: String,
    enterToClass: String,
    appearFromClass: String,
    appearActiveClass: String,
    appearToClass: String,
    leaveFromClass: String,
    leaveActiveClass: String,
    leaveToClass: String,
  },
  wd = ke({}, pu.props, ql),
  Bt = (e, t = []) => {
    H(e) ? e.forEach((n) => n(...t)) : e && e(...t);
  },
  Rs = (e) => (e ? (H(e) ? e.some((t) => t.length > 1) : e.length > 1) : !1);
function Ed(e) {
  const t = {};
  for (const I in e) I in ql || (t[I] = e[I]);
  if (e.css === !1) return t;
  const {
      name: n = "v",
      type: r,
      duration: a,
      enterFromClass: i = `${n}-enter-from`,
      enterActiveClass: s = `${n}-enter-active`,
      enterToClass: o = `${n}-enter-to`,
      appearFromClass: l = i,
      appearActiveClass: f = s,
      appearToClass: c = o,
      leaveFromClass: u = `${n}-leave-from`,
      leaveActiveClass: m = `${n}-leave-active`,
      leaveToClass: g = `${n}-leave-to`,
    } = e,
    E = Cd(a),
    T = E && E[0],
    A = E && E[1],
    {
      onBeforeEnter: v,
      onEnter: y,
      onEnterCancelled: $,
      onLeave: D,
      onLeaveCancelled: z,
      onBeforeAppear: te = v,
      onAppear: de = y,
      onAppearCancelled: W = $,
    } = t,
    G = (I, he, Oe) => {
      Ct(I, he ? c : o), Ct(I, he ? f : s), Oe && Oe();
    },
    ce = (I, he) => {
      (I._isLeaving = !1), Ct(I, u), Ct(I, g), Ct(I, m), he && he();
    },
    _e = (I) => (he, Oe) => {
      const st = I ? de : y,
        be = () => G(he, I, Oe);
      Bt(st, [he, be]),
        Ns(() => {
          Ct(he, I ? l : i), ct(he, I ? c : o), Rs(st) || Is(he, r, T, be);
        });
    };
  return ke(t, {
    onBeforeEnter(I) {
      Bt(v, [I]), ct(I, i), ct(I, s);
    },
    onBeforeAppear(I) {
      Bt(te, [I]), ct(I, l), ct(I, f);
    },
    onEnter: _e(!1),
    onAppear: _e(!0),
    onLeave(I, he) {
      I._isLeaving = !0;
      const Oe = () => ce(I, he);
      ct(I, u),
        Yl(),
        ct(I, m),
        Ns(() => {
          !I._isLeaving || (Ct(I, u), ct(I, g), Rs(D) || Is(I, r, A, Oe));
        }),
        Bt(D, [I, Oe]);
    },
    onEnterCancelled(I) {
      G(I, !1), Bt($, [I]);
    },
    onAppearCancelled(I) {
      G(I, !0), Bt(W, [I]);
    },
    onLeaveCancelled(I) {
      ce(I), Bt(z, [I]);
    },
  });
}
function Cd(e) {
  if (e == null) return null;
  if (xe(e)) return [ma(e.enter), ma(e.leave)];
  {
    const t = ma(e);
    return [t, t];
  }
}
function ma(e) {
  return Er(e);
}
function ct(e, t) {
  t.split(/\s+/).forEach((n) => n && e.classList.add(n)),
    (e._vtc || (e._vtc = new Set())).add(t);
}
function Ct(e, t) {
  t.split(/\s+/).forEach((r) => r && e.classList.remove(r));
  const { _vtc: n } = e;
  n && (n.delete(t), n.size || (e._vtc = void 0));
}
function Ns(e) {
  requestAnimationFrame(() => {
    requestAnimationFrame(e);
  });
}
let kd = 0;
function Is(e, t, n, r) {
  const a = (e._endId = ++kd),
    i = () => {
      a === e._endId && r();
    };
  if (n) return setTimeout(i, n);
  const { type: s, timeout: o, propCount: l } = Kl(e, t);
  if (!s) return r();
  const f = s + "end";
  let c = 0;
  const u = () => {
      e.removeEventListener(f, m), i();
    },
    m = (g) => {
      g.target === e && ++c >= l && u();
    };
  setTimeout(() => {
    c < l && u();
  }, o + 1),
    e.addEventListener(f, m);
}
function Kl(e, t) {
  const n = window.getComputedStyle(e),
    r = (E) => (n[E] || "").split(", "),
    a = r(yt + "Delay"),
    i = r(yt + "Duration"),
    s = Ms(a, i),
    o = r(Tn + "Delay"),
    l = r(Tn + "Duration"),
    f = Ms(o, l);
  let c = null,
    u = 0,
    m = 0;
  t === yt
    ? s > 0 && ((c = yt), (u = s), (m = i.length))
    : t === Tn
    ? f > 0 && ((c = Tn), (u = f), (m = l.length))
    : ((u = Math.max(s, f)),
      (c = u > 0 ? (s > f ? yt : Tn) : null),
      (m = c ? (c === yt ? i.length : l.length) : 0));
  const g = c === yt && /\b(transform|all)(,|$)/.test(n[yt + "Property"]);
  return { type: c, timeout: u, propCount: m, hasTransform: g };
}
function Ms(e, t) {
  for (; e.length < t.length; ) e = e.concat(e);
  return Math.max(...t.map((n, r) => Ls(n) + Ls(e[r])));
}
function Ls(e) {
  return Number(e.slice(0, -1).replace(",", ".")) * 1e3;
}
function Yl() {
  return document.body.offsetHeight;
}
const Gl = new WeakMap(),
  Xl = new WeakMap(),
  Ad = {
    name: "TransitionGroup",
    props: ke({}, wd, { tag: String, moveClass: String }),
    setup(e, { slots: t }) {
      const n = zl(),
        r = xl();
      let a, i;
      return (
        kl(() => {
          if (!a.length) return;
          const s = e.moveClass || `${e.name || "v"}-move`;
          if (!Pd(a[0].el, n.vnode.el, s)) return;
          a.forEach(Od), a.forEach(Sd);
          const o = a.filter(Td);
          Yl(),
            o.forEach((l) => {
              const f = l.el,
                c = f.style;
              ct(f, s),
                (c.transform = c.webkitTransform = c.transitionDuration = "");
              const u = (f._moveCb = (m) => {
                (m && m.target !== f) ||
                  ((!m || /transform$/.test(m.propertyName)) &&
                    (f.removeEventListener("transitionend", u),
                    (f._moveCb = null),
                    Ct(f, s)));
              });
              f.addEventListener("transitionend", u);
            });
        }),
        () => {
          const s = ee(e),
            o = Ed(s);
          let l = s.tag || ye;
          (a = i), (i = t.default ? wi(t.default()) : []);
          for (let f = 0; f < i.length; f++) {
            const c = i[f];
            c.key != null && Jn(c, Xn(c, o, r, n));
          }
          if (a)
            for (let f = 0; f < a.length; f++) {
              const c = a[f];
              Jn(c, Xn(c, o, r, n)), Gl.set(c, c.el.getBoundingClientRect());
            }
          return ne(l, null, i);
        }
      );
    },
  },
  Jl = Ad;
function Od(e) {
  const t = e.el;
  t._moveCb && t._moveCb(), t._enterCb && t._enterCb();
}
function Sd(e) {
  Xl.set(e, e.el.getBoundingClientRect());
}
function Td(e) {
  const t = Gl.get(e),
    n = Xl.get(e),
    r = t.left - n.left,
    a = t.top - n.top;
  if (r || a) {
    const i = e.el.style;
    return (
      (i.transform = i.webkitTransform = `translate(${r}px,${a}px)`),
      (i.transitionDuration = "0s"),
      e
    );
  }
}
function Pd(e, t, n) {
  const r = e.cloneNode();
  e._vtc &&
    e._vtc.forEach((s) => {
      s.split(/\s+/).forEach((o) => o && r.classList.remove(o));
    }),
    n.split(/\s+/).forEach((s) => s && r.classList.add(s)),
    (r.style.display = "none");
  const a = t.nodeType === 1 ? t : t.parentNode;
  a.appendChild(r);
  const { hasTransform: i } = Kl(r);
  return a.removeChild(r), i;
}
const Ds = (e) => {
  const t = e.props["onUpdate:modelValue"] || !1;
  return H(t) ? (n) => hr(t, n) : t;
};
function $d(e) {
  e.target.composing = !0;
}
function Fs(e) {
  const t = e.target;
  t.composing && ((t.composing = !1), t.dispatchEvent(new Event("input")));
}
const Rd = {
    created(e, { modifiers: { lazy: t, trim: n, number: r } }, a) {
      e._assign = Ds(a);
      const i = r || (a.props && a.props.type === "number");
      on(e, t ? "change" : "input", (s) => {
        if (s.target.composing) return;
        let o = e.value;
        n && (o = o.trim()), i && (o = Er(o)), e._assign(o);
      }),
        n &&
          on(e, "change", () => {
            e.value = e.value.trim();
          }),
        t ||
          (on(e, "compositionstart", $d),
          on(e, "compositionend", Fs),
          on(e, "change", Fs));
    },
    mounted(e, { value: t }) {
      e.value = t == null ? "" : t;
    },
    beforeUpdate(
      e,
      { value: t, modifiers: { lazy: n, trim: r, number: a } },
      i
    ) {
      if (
        ((e._assign = Ds(i)),
        e.composing ||
          (document.activeElement === e &&
            e.type !== "range" &&
            (n ||
              (r && e.value.trim() === t) ||
              ((a || e.type === "number") && Er(e.value) === t))))
      )
        return;
      const s = t == null ? "" : t;
      e.value !== s && (e.value = s);
    },
  },
  Nd = ke({ patchProp: _d }, id);
let js;
function Id() {
  return js || (js = Bu(Nd));
}
const Md = (...e) => {
  const t = Id().createApp(...e),
    { mount: n } = t;
  return (
    (t.mount = (r) => {
      const a = Ld(r);
      if (!a) return;
      const i = t._component;
      !q(i) && !i.render && !i.template && (i.template = a.innerHTML),
        (a.innerHTML = "");
      const s = n(a, !1, a instanceof SVGElement);
      return (
        a instanceof Element &&
          (a.removeAttribute("v-cloak"), a.setAttribute("data-v-app", "")),
        s
      );
    }),
    t
  );
};
function Ld(e) {
  return we(e) ? document.querySelector(e) : e;
}
/*!
 * Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com
 * License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
 * Copyright 2022 Fonticons, Inc.
 */ function Bs(e, t) {
  var n = Object.keys(e);
  if (Object.getOwnPropertySymbols) {
    var r = Object.getOwnPropertySymbols(e);
    t &&
      (r = r.filter(function (a) {
        return Object.getOwnPropertyDescriptor(e, a).enumerable;
      })),
      n.push.apply(n, r);
  }
  return n;
}
function N(e) {
  for (var t = 1; t < arguments.length; t++) {
    var n = arguments[t] != null ? arguments[t] : {};
    t % 2
      ? Bs(Object(n), !0).forEach(function (r) {
          jd(e, r, n[r]);
        })
      : Object.getOwnPropertyDescriptors
      ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
      : Bs(Object(n)).forEach(function (r) {
          Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(n, r));
        });
  }
  return e;
}
function Pr(e) {
  return (
    (Pr =
      typeof Symbol == "function" && typeof Symbol.iterator == "symbol"
        ? function (t) {
            return typeof t;
          }
        : function (t) {
            return t &&
              typeof Symbol == "function" &&
              t.constructor === Symbol &&
              t !== Symbol.prototype
              ? "symbol"
              : typeof t;
          }),
    Pr(e)
  );
}
function Dd(e, t) {
  if (!(e instanceof t))
    throw new TypeError("Cannot call a class as a function");
}
function Us(e, t) {
  for (var n = 0; n < t.length; n++) {
    var r = t[n];
    (r.enumerable = r.enumerable || !1),
      (r.configurable = !0),
      "value" in r && (r.writable = !0),
      Object.defineProperty(e, r.key, r);
  }
}
function Fd(e, t, n) {
  return (
    t && Us(e.prototype, t),
    n && Us(e, n),
    Object.defineProperty(e, "prototype", { writable: !1 }),
    e
  );
}
function jd(e, t, n) {
  return (
    t in e
      ? Object.defineProperty(e, t, {
          value: n,
          enumerable: !0,
          configurable: !0,
          writable: !0,
        })
      : (e[t] = n),
    e
  );
}
function Ti(e, t) {
  return Ud(e) || Hd(e, t) || Ql(e, t) || Wd();
}
function Zr(e) {
  return Bd(e) || zd(e) || Ql(e) || Vd();
}
function Bd(e) {
  if (Array.isArray(e)) return za(e);
}
function Ud(e) {
  if (Array.isArray(e)) return e;
}
function zd(e) {
  if (
    (typeof Symbol != "undefined" && e[Symbol.iterator] != null) ||
    e["@@iterator"] != null
  )
    return Array.from(e);
}
function Hd(e, t) {
  var n =
    e == null
      ? null
      : (typeof Symbol != "undefined" && e[Symbol.iterator]) || e["@@iterator"];
  if (n != null) {
    var r = [],
      a = !0,
      i = !1,
      s,
      o;
    try {
      for (
        n = n.call(e);
        !(a = (s = n.next()).done) && (r.push(s.value), !(t && r.length === t));
        a = !0
      );
    } catch (l) {
      (i = !0), (o = l);
    } finally {
      try {
        !a && n.return != null && n.return();
      } finally {
        if (i) throw o;
      }
    }
    return r;
  }
}
function Ql(e, t) {
  if (!!e) {
    if (typeof e == "string") return za(e, t);
    var n = Object.prototype.toString.call(e).slice(8, -1);
    if (
      (n === "Object" && e.constructor && (n = e.constructor.name),
      n === "Map" || n === "Set")
    )
      return Array.from(e);
    if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))
      return za(e, t);
  }
}
function za(e, t) {
  (t == null || t > e.length) && (t = e.length);
  for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
  return r;
}
function Vd() {
  throw new TypeError(`Invalid attempt to spread non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`);
}
function Wd() {
  throw new TypeError(`Invalid attempt to destructure non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`);
}
var zs = function () {},
  Pi = {},
  Zl = {},
  ec = null,
  tc = { mark: zs, measure: zs };
try {
  typeof window != "undefined" && (Pi = window),
    typeof document != "undefined" && (Zl = document),
    typeof MutationObserver != "undefined" && (ec = MutationObserver),
    typeof performance != "undefined" && (tc = performance);
} catch {}
var qd = Pi.navigator || {},
  Hs = qd.userAgent,
  Vs = Hs === void 0 ? "" : Hs,
  Nt = Pi,
  ge = Zl,
  Ws = ec,
  cr = tc;
Nt.document;
var vt =
    !!ge.documentElement &&
    !!ge.head &&
    typeof ge.addEventListener == "function" &&
    typeof ge.createElement == "function",
  nc = ~Vs.indexOf("MSIE") || ~Vs.indexOf("Trident/"),
  ht = "___FONT_AWESOME___",
  Ha = 16,
  rc = "fa",
  ac = "svg-inline--fa",
  Xt = "data-fa-i2svg",
  Va = "data-fa-pseudo-element",
  Kd = "data-fa-pseudo-element-pending",
  $i = "data-prefix",
  Ri = "data-icon",
  qs = "fontawesome-i2svg",
  Yd = "async",
  Gd = ["HTML", "HEAD", "STYLE", "SCRIPT"],
  ic = (function () {
    try {
      return !0;
    } catch {
      return !1;
    }
  })(),
  Ni = {
    fas: "solid",
    "fa-solid": "solid",
    far: "regular",
    "fa-regular": "regular",
    fal: "light",
    "fa-light": "light",
    fat: "thin",
    "fa-thin": "thin",
    fad: "duotone",
    "fa-duotone": "duotone",
    fab: "brands",
    "fa-brands": "brands",
    fak: "kit",
    "fa-kit": "kit",
    fa: "solid",
  },
  $r = {
    solid: "fas",
    regular: "far",
    light: "fal",
    thin: "fat",
    duotone: "fad",
    brands: "fab",
    kit: "fak",
  },
  sc = {
    fab: "fa-brands",
    fad: "fa-duotone",
    fak: "fa-kit",
    fal: "fa-light",
    far: "fa-regular",
    fas: "fa-solid",
    fat: "fa-thin",
  },
  Xd = {
    "fa-brands": "fab",
    "fa-duotone": "fad",
    "fa-kit": "fak",
    "fa-light": "fal",
    "fa-regular": "far",
    "fa-solid": "fas",
    "fa-thin": "fat",
  },
  Jd = /fa[srltdbk\-\ ]/,
  oc = "fa-layers-text",
  Qd =
    /Font ?Awesome ?([56 ]*)(Solid|Regular|Light|Thin|Duotone|Brands|Free|Pro|Kit)?.*/i,
  Zd = { 900: "fas", 400: "far", normal: "far", 300: "fal", 100: "fat" },
  lc = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
  eh = lc.concat([11, 12, 13, 14, 15, 16, 17, 18, 19, 20]),
  th = [
    "class",
    "data-prefix",
    "data-icon",
    "data-fa-transform",
    "data-fa-mask",
  ],
  Wt = {
    GROUP: "duotone-group",
    SWAP_OPACITY: "swap-opacity",
    PRIMARY: "primary",
    SECONDARY: "secondary",
  },
  nh = []
    .concat(Zr(Object.keys($r)), [
      "2xs",
      "xs",
      "sm",
      "lg",
      "xl",
      "2xl",
      "beat",
      "border",
      "fade",
      "beat-fade",
      "bounce",
      "flip-both",
      "flip-horizontal",
      "flip-vertical",
      "flip",
      "fw",
      "inverse",
      "layers-counter",
      "layers-text",
      "layers",
      "li",
      "pull-left",
      "pull-right",
      "pulse",
      "rotate-180",
      "rotate-270",
      "rotate-90",
      "rotate-by",
      "shake",
      "spin-pulse",
      "spin-reverse",
      "spin",
      "stack-1x",
      "stack-2x",
      "stack",
      "ul",
      Wt.GROUP,
      Wt.SWAP_OPACITY,
      Wt.PRIMARY,
      Wt.SECONDARY,
    ])
    .concat(
      lc.map(function (e) {
        return "".concat(e, "x");
      })
    )
    .concat(
      eh.map(function (e) {
        return "w-".concat(e);
      })
    ),
  cc = Nt.FontAwesomeConfig || {};
function rh(e) {
  var t = ge.querySelector("script[" + e + "]");
  if (t) return t.getAttribute(e);
}
function ah(e) {
  return e === "" ? !0 : e === "false" ? !1 : e === "true" ? !0 : e;
}
if (ge && typeof ge.querySelector == "function") {
  var ih = [
    ["data-family-prefix", "familyPrefix"],
    ["data-style-default", "styleDefault"],
    ["data-replacement-class", "replacementClass"],
    ["data-auto-replace-svg", "autoReplaceSvg"],
    ["data-auto-add-css", "autoAddCss"],
    ["data-auto-a11y", "autoA11y"],
    ["data-search-pseudo-elements", "searchPseudoElements"],
    ["data-observe-mutations", "observeMutations"],
    ["data-mutate-approach", "mutateApproach"],
    ["data-keep-original-source", "keepOriginalSource"],
    ["data-measure-performance", "measurePerformance"],
    ["data-show-missing-icons", "showMissingIcons"],
  ];
  ih.forEach(function (e) {
    var t = Ti(e, 2),
      n = t[0],
      r = t[1],
      a = ah(rh(n));
    a != null && (cc[r] = a);
  });
}
var sh = {
    familyPrefix: rc,
    styleDefault: "solid",
    replacementClass: ac,
    autoReplaceSvg: !0,
    autoAddCss: !0,
    autoA11y: !0,
    searchPseudoElements: !1,
    observeMutations: !0,
    mutateApproach: "async",
    keepOriginalSource: !0,
    measurePerformance: !1,
    showMissingIcons: !0,
  },
  Un = N(N({}, sh), cc);
Un.autoReplaceSvg || (Un.observeMutations = !1);
var U = {};
Object.keys(Un).forEach(function (e) {
  Object.defineProperty(U, e, {
    enumerable: !0,
    set: function (n) {
      (Un[e] = n),
        vr.forEach(function (r) {
          return r(U);
        });
    },
    get: function () {
      return Un[e];
    },
  });
});
Nt.FontAwesomeConfig = U;
var vr = [];
function oh(e) {
  return (
    vr.push(e),
    function () {
      vr.splice(vr.indexOf(e), 1);
    }
  );
}
var _t = Ha,
  at = { size: 16, x: 0, y: 0, rotate: 0, flipX: !1, flipY: !1 };
function lh(e) {
  if (!(!e || !vt)) {
    var t = ge.createElement("style");
    t.setAttribute("type", "text/css"), (t.innerHTML = e);
    for (var n = ge.head.childNodes, r = null, a = n.length - 1; a > -1; a--) {
      var i = n[a],
        s = (i.tagName || "").toUpperCase();
      ["STYLE", "LINK"].indexOf(s) > -1 && (r = i);
    }
    return ge.head.insertBefore(t, r), e;
  }
}
var ch = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
function er() {
  for (var e = 12, t = ""; e-- > 0; ) t += ch[(Math.random() * 62) | 0];
  return t;
}
function kn(e) {
  for (var t = [], n = (e || []).length >>> 0; n--; ) t[n] = e[n];
  return t;
}
function Ii(e) {
  return e.classList
    ? kn(e.classList)
    : (e.getAttribute("class") || "").split(" ").filter(function (t) {
        return t;
      });
}
function fc(e) {
  return ""
    .concat(e)
    .replace(/&/g, "&amp;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;");
}
function fh(e) {
  return Object.keys(e || {})
    .reduce(function (t, n) {
      return t + "".concat(n, '="').concat(fc(e[n]), '" ');
    }, "")
    .trim();
}
function ea(e) {
  return Object.keys(e || {}).reduce(function (t, n) {
    return t + "".concat(n, ": ").concat(e[n].trim(), ";");
  }, "");
}
function Mi(e) {
  return (
    e.size !== at.size ||
    e.x !== at.x ||
    e.y !== at.y ||
    e.rotate !== at.rotate ||
    e.flipX ||
    e.flipY
  );
}
function uh(e) {
  var t = e.transform,
    n = e.containerWidth,
    r = e.iconWidth,
    a = { transform: "translate(".concat(n / 2, " 256)") },
    i = "translate(".concat(t.x * 32, ", ").concat(t.y * 32, ") "),
    s = "scale("
      .concat((t.size / 16) * (t.flipX ? -1 : 1), ", ")
      .concat((t.size / 16) * (t.flipY ? -1 : 1), ") "),
    o = "rotate(".concat(t.rotate, " 0 0)"),
    l = { transform: "".concat(i, " ").concat(s, " ").concat(o) },
    f = { transform: "translate(".concat((r / 2) * -1, " -256)") };
  return { outer: a, inner: l, path: f };
}
function dh(e) {
  var t = e.transform,
    n = e.width,
    r = n === void 0 ? Ha : n,
    a = e.height,
    i = a === void 0 ? Ha : a,
    s = e.startCentered,
    o = s === void 0 ? !1 : s,
    l = "";
  return (
    o && nc
      ? (l += "translate("
          .concat(t.x / _t - r / 2, "em, ")
          .concat(t.y / _t - i / 2, "em) "))
      : o
      ? (l += "translate(calc(-50% + "
          .concat(t.x / _t, "em), calc(-50% + ")
          .concat(t.y / _t, "em)) "))
      : (l += "translate(".concat(t.x / _t, "em, ").concat(t.y / _t, "em) ")),
    (l += "scale("
      .concat((t.size / _t) * (t.flipX ? -1 : 1), ", ")
      .concat((t.size / _t) * (t.flipY ? -1 : 1), ") ")),
    (l += "rotate(".concat(t.rotate, "deg) ")),
    l
  );
}
var hh = `:root, :host {
  --fa-font-solid: normal 900 1em/1 "Font Awesome 6 Solid";
  --fa-font-regular: normal 400 1em/1 "Font Awesome 6 Regular";
  --fa-font-light: normal 300 1em/1 "Font Awesome 6 Light";
  --fa-font-thin: normal 100 1em/1 "Font Awesome 6 Thin";
  --fa-font-duotone: normal 900 1em/1 "Font Awesome 6 Duotone";
  --fa-font-brands: normal 400 1em/1 "Font Awesome 6 Brands";
}

svg:not(:root).svg-inline--fa, svg:not(:host).svg-inline--fa {
  overflow: visible;
  box-sizing: content-box;
}

.svg-inline--fa {
  display: var(--fa-display, inline-block);
  height: 1em;
  overflow: visible;
  vertical-align: -0.125em;
}
.svg-inline--fa.fa-2xs {
  vertical-align: 0.1em;
}
.svg-inline--fa.fa-xs {
  vertical-align: 0em;
}
.svg-inline--fa.fa-sm {
  vertical-align: -0.0714285705em;
}
.svg-inline--fa.fa-lg {
  vertical-align: -0.2em;
}
.svg-inline--fa.fa-xl {
  vertical-align: -0.25em;
}
.svg-inline--fa.fa-2xl {
  vertical-align: -0.3125em;
}
.svg-inline--fa.fa-pull-left {
  margin-right: var(--fa-pull-margin, 0.3em);
  width: auto;
}
.svg-inline--fa.fa-pull-right {
  margin-left: var(--fa-pull-margin, 0.3em);
  width: auto;
}
.svg-inline--fa.fa-li {
  width: var(--fa-li-width, 2em);
  top: 0.25em;
}
.svg-inline--fa.fa-fw {
  width: var(--fa-fw-width, 1.25em);
}

.fa-layers svg.svg-inline--fa {
  bottom: 0;
  left: 0;
  margin: auto;
  position: absolute;
  right: 0;
  top: 0;
}

.fa-layers-counter, .fa-layers-text {
  display: inline-block;
  position: absolute;
  text-align: center;
}

.fa-layers {
  display: inline-block;
  height: 1em;
  position: relative;
  text-align: center;
  vertical-align: -0.125em;
  width: 1em;
}
.fa-layers svg.svg-inline--fa {
  -webkit-transform-origin: center center;
          transform-origin: center center;
}

.fa-layers-text {
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  -webkit-transform-origin: center center;
          transform-origin: center center;
}

.fa-layers-counter {
  background-color: var(--fa-counter-background-color, #ff253a);
  border-radius: var(--fa-counter-border-radius, 1em);
  box-sizing: border-box;
  color: var(--fa-inverse, #fff);
  line-height: var(--fa-counter-line-height, 1);
  max-width: var(--fa-counter-max-width, 5em);
  min-width: var(--fa-counter-min-width, 1.5em);
  overflow: hidden;
  padding: var(--fa-counter-padding, 0.25em 0.5em);
  right: var(--fa-right, 0);
  text-overflow: ellipsis;
  top: var(--fa-top, 0);
  -webkit-transform: scale(var(--fa-counter-scale, 0.25));
          transform: scale(var(--fa-counter-scale, 0.25));
  -webkit-transform-origin: top right;
          transform-origin: top right;
}

.fa-layers-bottom-right {
  bottom: var(--fa-bottom, 0);
  right: var(--fa-right, 0);
  top: auto;
  -webkit-transform: scale(var(--fa-layers-scale, 0.25));
          transform: scale(var(--fa-layers-scale, 0.25));
  -webkit-transform-origin: bottom right;
          transform-origin: bottom right;
}

.fa-layers-bottom-left {
  bottom: var(--fa-bottom, 0);
  left: var(--fa-left, 0);
  right: auto;
  top: auto;
  -webkit-transform: scale(var(--fa-layers-scale, 0.25));
          transform: scale(var(--fa-layers-scale, 0.25));
  -webkit-transform-origin: bottom left;
          transform-origin: bottom left;
}

.fa-layers-top-right {
  top: var(--fa-top, 0);
  right: var(--fa-right, 0);
  -webkit-transform: scale(var(--fa-layers-scale, 0.25));
          transform: scale(var(--fa-layers-scale, 0.25));
  -webkit-transform-origin: top right;
          transform-origin: top right;
}

.fa-layers-top-left {
  left: var(--fa-left, 0);
  right: auto;
  top: var(--fa-top, 0);
  -webkit-transform: scale(var(--fa-layers-scale, 0.25));
          transform: scale(var(--fa-layers-scale, 0.25));
  -webkit-transform-origin: top left;
          transform-origin: top left;
}

.fa-1x {
  font-size: 1em;
}

.fa-2x {
  font-size: 2em;
}

.fa-3x {
  font-size: 3em;
}

.fa-4x {
  font-size: 4em;
}

.fa-5x {
  font-size: 5em;
}

.fa-6x {
  font-size: 6em;
}

.fa-7x {
  font-size: 7em;
}

.fa-8x {
  font-size: 8em;
}

.fa-9x {
  font-size: 9em;
}

.fa-10x {
  font-size: 10em;
}

.fa-2xs {
  font-size: 0.625em;
  line-height: 0.1em;
  vertical-align: 0.225em;
}

.fa-xs {
  font-size: 0.75em;
  line-height: 0.0833333337em;
  vertical-align: 0.125em;
}

.fa-sm {
  font-size: 0.875em;
  line-height: 0.0714285718em;
  vertical-align: 0.0535714295em;
}

.fa-lg {
  font-size: 1.25em;
  line-height: 0.05em;
  vertical-align: -0.075em;
}

.fa-xl {
  font-size: 1.5em;
  line-height: 0.0416666682em;
  vertical-align: -0.125em;
}

.fa-2xl {
  font-size: 2em;
  line-height: 0.03125em;
  vertical-align: -0.1875em;
}

.fa-fw {
  text-align: center;
  width: 1.25em;
}

.fa-ul {
  list-style-type: none;
  margin-left: var(--fa-li-margin, 2.5em);
  padding-left: 0;
}
.fa-ul > li {
  position: relative;
}

.fa-li {
  left: calc(var(--fa-li-width, 2em) * -1);
  position: absolute;
  text-align: center;
  width: var(--fa-li-width, 2em);
  line-height: inherit;
}

.fa-border {
  border-color: var(--fa-border-color, #eee);
  border-radius: var(--fa-border-radius, 0.1em);
  border-style: var(--fa-border-style, solid);
  border-width: var(--fa-border-width, 0.08em);
  padding: var(--fa-border-padding, 0.2em 0.25em 0.15em);
}

.fa-pull-left {
  float: left;
  margin-right: var(--fa-pull-margin, 0.3em);
}

.fa-pull-right {
  float: right;
  margin-left: var(--fa-pull-margin, 0.3em);
}

.fa-beat {
  -webkit-animation-name: fa-beat;
          animation-name: fa-beat;
  -webkit-animation-delay: var(--fa-animation-delay, 0);
          animation-delay: var(--fa-animation-delay, 0);
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 1s);
          animation-duration: var(--fa-animation-duration, 1s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, ease-in-out);
          animation-timing-function: var(--fa-animation-timing, ease-in-out);
}

.fa-bounce {
  -webkit-animation-name: fa-bounce;
          animation-name: fa-bounce;
  -webkit-animation-delay: var(--fa-animation-delay, 0);
          animation-delay: var(--fa-animation-delay, 0);
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 1s);
          animation-duration: var(--fa-animation-duration, 1s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, cubic-bezier(0.28, 0.84, 0.42, 1));
          animation-timing-function: var(--fa-animation-timing, cubic-bezier(0.28, 0.84, 0.42, 1));
}

.fa-fade {
  -webkit-animation-name: fa-fade;
          animation-name: fa-fade;
  -webkit-animation-delay: var(--fa-animation-delay, 0);
          animation-delay: var(--fa-animation-delay, 0);
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 1s);
          animation-duration: var(--fa-animation-duration, 1s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, cubic-bezier(0.4, 0, 0.6, 1));
          animation-timing-function: var(--fa-animation-timing, cubic-bezier(0.4, 0, 0.6, 1));
}

.fa-beat-fade {
  -webkit-animation-name: fa-beat-fade;
          animation-name: fa-beat-fade;
  -webkit-animation-delay: var(--fa-animation-delay, 0);
          animation-delay: var(--fa-animation-delay, 0);
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 1s);
          animation-duration: var(--fa-animation-duration, 1s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, cubic-bezier(0.4, 0, 0.6, 1));
          animation-timing-function: var(--fa-animation-timing, cubic-bezier(0.4, 0, 0.6, 1));
}

.fa-flip {
  -webkit-animation-name: fa-flip;
          animation-name: fa-flip;
  -webkit-animation-delay: var(--fa-animation-delay, 0);
          animation-delay: var(--fa-animation-delay, 0);
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 1s);
          animation-duration: var(--fa-animation-duration, 1s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, ease-in-out);
          animation-timing-function: var(--fa-animation-timing, ease-in-out);
}

.fa-shake {
  -webkit-animation-name: fa-shake;
          animation-name: fa-shake;
  -webkit-animation-delay: var(--fa-animation-delay, 0);
          animation-delay: var(--fa-animation-delay, 0);
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 1s);
          animation-duration: var(--fa-animation-duration, 1s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, linear);
          animation-timing-function: var(--fa-animation-timing, linear);
}

.fa-spin {
  -webkit-animation-name: fa-spin;
          animation-name: fa-spin;
  -webkit-animation-delay: var(--fa-animation-delay, 0);
          animation-delay: var(--fa-animation-delay, 0);
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 2s);
          animation-duration: var(--fa-animation-duration, 2s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, linear);
          animation-timing-function: var(--fa-animation-timing, linear);
}

.fa-spin-reverse {
  --fa-animation-direction: reverse;
}

.fa-pulse,
.fa-spin-pulse {
  -webkit-animation-name: fa-spin;
          animation-name: fa-spin;
  -webkit-animation-direction: var(--fa-animation-direction, normal);
          animation-direction: var(--fa-animation-direction, normal);
  -webkit-animation-duration: var(--fa-animation-duration, 1s);
          animation-duration: var(--fa-animation-duration, 1s);
  -webkit-animation-iteration-count: var(--fa-animation-iteration-count, infinite);
          animation-iteration-count: var(--fa-animation-iteration-count, infinite);
  -webkit-animation-timing-function: var(--fa-animation-timing, steps(8));
          animation-timing-function: var(--fa-animation-timing, steps(8));
}

@media (prefers-reduced-motion: reduce) {
  .fa-beat,
.fa-bounce,
.fa-fade,
.fa-beat-fade,
.fa-flip,
.fa-pulse,
.fa-shake,
.fa-spin,
.fa-spin-pulse {
    -webkit-animation-delay: -1ms;
            animation-delay: -1ms;
    -webkit-animation-duration: 1ms;
            animation-duration: 1ms;
    -webkit-animation-iteration-count: 1;
            animation-iteration-count: 1;
    transition-delay: 0s;
    transition-duration: 0s;
  }
}
@-webkit-keyframes fa-beat {
  0%, 90% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  45% {
    -webkit-transform: scale(var(--fa-beat-scale, 1.25));
            transform: scale(var(--fa-beat-scale, 1.25));
  }
}
@keyframes fa-beat {
  0%, 90% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  45% {
    -webkit-transform: scale(var(--fa-beat-scale, 1.25));
            transform: scale(var(--fa-beat-scale, 1.25));
  }
}
@-webkit-keyframes fa-bounce {
  0% {
    -webkit-transform: scale(1, 1) translateY(0);
            transform: scale(1, 1) translateY(0);
  }
  10% {
    -webkit-transform: scale(var(--fa-bounce-start-scale-x, 1.1), var(--fa-bounce-start-scale-y, 0.9)) translateY(0);
            transform: scale(var(--fa-bounce-start-scale-x, 1.1), var(--fa-bounce-start-scale-y, 0.9)) translateY(0);
  }
  30% {
    -webkit-transform: scale(var(--fa-bounce-jump-scale-x, 0.9), var(--fa-bounce-jump-scale-y, 1.1)) translateY(var(--fa-bounce-height, -0.5em));
            transform: scale(var(--fa-bounce-jump-scale-x, 0.9), var(--fa-bounce-jump-scale-y, 1.1)) translateY(var(--fa-bounce-height, -0.5em));
  }
  50% {
    -webkit-transform: scale(var(--fa-bounce-land-scale-x, 1.05), var(--fa-bounce-land-scale-y, 0.95)) translateY(0);
            transform: scale(var(--fa-bounce-land-scale-x, 1.05), var(--fa-bounce-land-scale-y, 0.95)) translateY(0);
  }
  57% {
    -webkit-transform: scale(1, 1) translateY(var(--fa-bounce-rebound, -0.125em));
            transform: scale(1, 1) translateY(var(--fa-bounce-rebound, -0.125em));
  }
  64% {
    -webkit-transform: scale(1, 1) translateY(0);
            transform: scale(1, 1) translateY(0);
  }
  100% {
    -webkit-transform: scale(1, 1) translateY(0);
            transform: scale(1, 1) translateY(0);
  }
}
@keyframes fa-bounce {
  0% {
    -webkit-transform: scale(1, 1) translateY(0);
            transform: scale(1, 1) translateY(0);
  }
  10% {
    -webkit-transform: scale(var(--fa-bounce-start-scale-x, 1.1), var(--fa-bounce-start-scale-y, 0.9)) translateY(0);
            transform: scale(var(--fa-bounce-start-scale-x, 1.1), var(--fa-bounce-start-scale-y, 0.9)) translateY(0);
  }
  30% {
    -webkit-transform: scale(var(--fa-bounce-jump-scale-x, 0.9), var(--fa-bounce-jump-scale-y, 1.1)) translateY(var(--fa-bounce-height, -0.5em));
            transform: scale(var(--fa-bounce-jump-scale-x, 0.9), var(--fa-bounce-jump-scale-y, 1.1)) translateY(var(--fa-bounce-height, -0.5em));
  }
  50% {
    -webkit-transform: scale(var(--fa-bounce-land-scale-x, 1.05), var(--fa-bounce-land-scale-y, 0.95)) translateY(0);
            transform: scale(var(--fa-bounce-land-scale-x, 1.05), var(--fa-bounce-land-scale-y, 0.95)) translateY(0);
  }
  57% {
    -webkit-transform: scale(1, 1) translateY(var(--fa-bounce-rebound, -0.125em));
            transform: scale(1, 1) translateY(var(--fa-bounce-rebound, -0.125em));
  }
  64% {
    -webkit-transform: scale(1, 1) translateY(0);
            transform: scale(1, 1) translateY(0);
  }
  100% {
    -webkit-transform: scale(1, 1) translateY(0);
            transform: scale(1, 1) translateY(0);
  }
}
@-webkit-keyframes fa-fade {
  50% {
    opacity: var(--fa-fade-opacity, 0.4);
  }
}
@keyframes fa-fade {
  50% {
    opacity: var(--fa-fade-opacity, 0.4);
  }
}
@-webkit-keyframes fa-beat-fade {
  0%, 100% {
    opacity: var(--fa-beat-fade-opacity, 0.4);
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  50% {
    opacity: 1;
    -webkit-transform: scale(var(--fa-beat-fade-scale, 1.125));
            transform: scale(var(--fa-beat-fade-scale, 1.125));
  }
}
@keyframes fa-beat-fade {
  0%, 100% {
    opacity: var(--fa-beat-fade-opacity, 0.4);
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  50% {
    opacity: 1;
    -webkit-transform: scale(var(--fa-beat-fade-scale, 1.125));
            transform: scale(var(--fa-beat-fade-scale, 1.125));
  }
}
@-webkit-keyframes fa-flip {
  50% {
    -webkit-transform: rotate3d(var(--fa-flip-x, 0), var(--fa-flip-y, 1), var(--fa-flip-z, 0), var(--fa-flip-angle, -180deg));
            transform: rotate3d(var(--fa-flip-x, 0), var(--fa-flip-y, 1), var(--fa-flip-z, 0), var(--fa-flip-angle, -180deg));
  }
}
@keyframes fa-flip {
  50% {
    -webkit-transform: rotate3d(var(--fa-flip-x, 0), var(--fa-flip-y, 1), var(--fa-flip-z, 0), var(--fa-flip-angle, -180deg));
            transform: rotate3d(var(--fa-flip-x, 0), var(--fa-flip-y, 1), var(--fa-flip-z, 0), var(--fa-flip-angle, -180deg));
  }
}
@-webkit-keyframes fa-shake {
  0% {
    -webkit-transform: rotate(-15deg);
            transform: rotate(-15deg);
  }
  4% {
    -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
  }
  8%, 24% {
    -webkit-transform: rotate(-18deg);
            transform: rotate(-18deg);
  }
  12%, 28% {
    -webkit-transform: rotate(18deg);
            transform: rotate(18deg);
  }
  16% {
    -webkit-transform: rotate(-22deg);
            transform: rotate(-22deg);
  }
  20% {
    -webkit-transform: rotate(22deg);
            transform: rotate(22deg);
  }
  32% {
    -webkit-transform: rotate(-12deg);
            transform: rotate(-12deg);
  }
  36% {
    -webkit-transform: rotate(12deg);
            transform: rotate(12deg);
  }
  40%, 100% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
}
@keyframes fa-shake {
  0% {
    -webkit-transform: rotate(-15deg);
            transform: rotate(-15deg);
  }
  4% {
    -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
  }
  8%, 24% {
    -webkit-transform: rotate(-18deg);
            transform: rotate(-18deg);
  }
  12%, 28% {
    -webkit-transform: rotate(18deg);
            transform: rotate(18deg);
  }
  16% {
    -webkit-transform: rotate(-22deg);
            transform: rotate(-22deg);
  }
  20% {
    -webkit-transform: rotate(22deg);
            transform: rotate(22deg);
  }
  32% {
    -webkit-transform: rotate(-12deg);
            transform: rotate(-12deg);
  }
  36% {
    -webkit-transform: rotate(12deg);
            transform: rotate(12deg);
  }
  40%, 100% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
}
@-webkit-keyframes fa-spin {
  0% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
@keyframes fa-spin {
  0% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
.fa-rotate-90 {
  -webkit-transform: rotate(90deg);
          transform: rotate(90deg);
}

.fa-rotate-180 {
  -webkit-transform: rotate(180deg);
          transform: rotate(180deg);
}

.fa-rotate-270 {
  -webkit-transform: rotate(270deg);
          transform: rotate(270deg);
}

.fa-flip-horizontal {
  -webkit-transform: scale(-1, 1);
          transform: scale(-1, 1);
}

.fa-flip-vertical {
  -webkit-transform: scale(1, -1);
          transform: scale(1, -1);
}

.fa-flip-both,
.fa-flip-horizontal.fa-flip-vertical {
  -webkit-transform: scale(-1, -1);
          transform: scale(-1, -1);
}

.fa-rotate-by {
  -webkit-transform: rotate(var(--fa-rotate-angle, none));
          transform: rotate(var(--fa-rotate-angle, none));
}

.fa-stack {
  display: inline-block;
  vertical-align: middle;
  height: 2em;
  position: relative;
  width: 2.5em;
}

.fa-stack-1x,
.fa-stack-2x {
  bottom: 0;
  left: 0;
  margin: auto;
  position: absolute;
  right: 0;
  top: 0;
  z-index: var(--fa-stack-z-index, auto);
}

.svg-inline--fa.fa-stack-1x {
  height: 1em;
  width: 1.25em;
}
.svg-inline--fa.fa-stack-2x {
  height: 2em;
  width: 2.5em;
}

.fa-inverse {
  color: var(--fa-inverse, #fff);
}

.sr-only,
.fa-sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border-width: 0;
}

.sr-only-focusable:not(:focus),
.fa-sr-only-focusable:not(:focus) {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border-width: 0;
}

.svg-inline--fa .fa-primary {
  fill: var(--fa-primary-color, currentColor);
  opacity: var(--fa-primary-opacity, 1);
}

.svg-inline--fa .fa-secondary {
  fill: var(--fa-secondary-color, currentColor);
  opacity: var(--fa-secondary-opacity, 0.4);
}

.svg-inline--fa.fa-swap-opacity .fa-primary {
  opacity: var(--fa-secondary-opacity, 0.4);
}

.svg-inline--fa.fa-swap-opacity .fa-secondary {
  opacity: var(--fa-primary-opacity, 1);
}

.svg-inline--fa mask .fa-primary,
.svg-inline--fa mask .fa-secondary {
  fill: black;
}

.fad.fa-inverse,
.fa-duotone.fa-inverse {
  color: var(--fa-inverse, #fff);
}`;
function uc() {
  var e = rc,
    t = ac,
    n = U.familyPrefix,
    r = U.replacementClass,
    a = hh;
  if (n !== e || r !== t) {
    var i = new RegExp("\\.".concat(e, "\\-"), "g"),
      s = new RegExp("\\--".concat(e, "\\-"), "g"),
      o = new RegExp("\\.".concat(t), "g");
    a = a
      .replace(i, ".".concat(n, "-"))
      .replace(s, "--".concat(n, "-"))
      .replace(o, ".".concat(r));
  }
  return a;
}
var Ks = !1;
function pa() {
  U.autoAddCss && !Ks && (lh(uc()), (Ks = !0));
}
var mh = {
    mixout: function () {
      return { dom: { css: uc, insertCss: pa } };
    },
    hooks: function () {
      return {
        beforeDOMElementCreation: function () {
          pa();
        },
        beforeI2svg: function () {
          pa();
        },
      };
    },
  },
  mt = Nt || {};
mt[ht] || (mt[ht] = {});
mt[ht].styles || (mt[ht].styles = {});
mt[ht].hooks || (mt[ht].hooks = {});
mt[ht].shims || (mt[ht].shims = []);
var Xe = mt[ht],
  dc = [],
  ph = function e() {
    ge.removeEventListener("DOMContentLoaded", e),
      (Rr = 1),
      dc.map(function (t) {
        return t();
      });
  },
  Rr = !1;
vt &&
  ((Rr = (ge.documentElement.doScroll ? /^loaded|^c/ : /^loaded|^i|^c/).test(
    ge.readyState
  )),
  Rr || ge.addEventListener("DOMContentLoaded", ph));
function gh(e) {
  !vt || (Rr ? setTimeout(e, 0) : dc.push(e));
}
function rr(e) {
  var t = e.tag,
    n = e.attributes,
    r = n === void 0 ? {} : n,
    a = e.children,
    i = a === void 0 ? [] : a;
  return typeof e == "string"
    ? fc(e)
    : "<"
        .concat(t, " ")
        .concat(fh(r), ">")
        .concat(i.map(rr).join(""), "</")
        .concat(t, ">");
}
function Ys(e, t, n) {
  if (e && e[t] && e[t][n]) return { prefix: t, iconName: n, icon: e[t][n] };
}
var vh = function (t, n) {
    return function (r, a, i, s) {
      return t.call(n, r, a, i, s);
    };
  },
  ga = function (t, n, r, a) {
    var i = Object.keys(t),
      s = i.length,
      o = a !== void 0 ? vh(n, a) : n,
      l,
      f,
      c;
    for (
      r === void 0 ? ((l = 1), (c = t[i[0]])) : ((l = 0), (c = r));
      l < s;
      l++
    )
      (f = i[l]), (c = o(c, t[f], f, t));
    return c;
  };
function bh(e) {
  for (var t = [], n = 0, r = e.length; n < r; ) {
    var a = e.charCodeAt(n++);
    if (a >= 55296 && a <= 56319 && n < r) {
      var i = e.charCodeAt(n++);
      (i & 64512) == 56320
        ? t.push(((a & 1023) << 10) + (i & 1023) + 65536)
        : (t.push(a), n--);
    } else t.push(a);
  }
  return t;
}
function Wa(e) {
  var t = bh(e);
  return t.length === 1 ? t[0].toString(16) : null;
}
function yh(e, t) {
  var n = e.length,
    r = e.charCodeAt(t),
    a;
  return r >= 55296 &&
    r <= 56319 &&
    n > t + 1 &&
    ((a = e.charCodeAt(t + 1)), a >= 56320 && a <= 57343)
    ? (r - 55296) * 1024 + a - 56320 + 65536
    : r;
}
function Gs(e) {
  return Object.keys(e).reduce(function (t, n) {
    var r = e[n],
      a = !!r.icon;
    return a ? (t[r.iconName] = r.icon) : (t[n] = r), t;
  }, {});
}
function qa(e, t) {
  var n = arguments.length > 2 && arguments[2] !== void 0 ? arguments[2] : {},
    r = n.skipHooks,
    a = r === void 0 ? !1 : r,
    i = Gs(t);
  typeof Xe.hooks.addPack == "function" && !a
    ? Xe.hooks.addPack(e, Gs(t))
    : (Xe.styles[e] = N(N({}, Xe.styles[e] || {}), i)),
    e === "fas" && qa("fa", t);
}
var zn = Xe.styles,
  _h = Xe.shims,
  xh = Object.values(sc),
  Li = null,
  hc = {},
  mc = {},
  pc = {},
  gc = {},
  vc = {},
  wh = Object.keys(Ni);
function Eh(e) {
  return ~nh.indexOf(e);
}
function Ch(e, t) {
  var n = t.split("-"),
    r = n[0],
    a = n.slice(1).join("-");
  return r === e && a !== "" && !Eh(a) ? a : null;
}
var bc = function () {
  var t = function (i) {
    return ga(
      zn,
      function (s, o, l) {
        return (s[l] = ga(o, i, {})), s;
      },
      {}
    );
  };
  (hc = t(function (a, i, s) {
    if ((i[3] && (a[i[3]] = s), i[2])) {
      var o = i[2].filter(function (l) {
        return typeof l == "number";
      });
      o.forEach(function (l) {
        a[l.toString(16)] = s;
      });
    }
    return a;
  })),
    (mc = t(function (a, i, s) {
      if (((a[s] = s), i[2])) {
        var o = i[2].filter(function (l) {
          return typeof l == "string";
        });
        o.forEach(function (l) {
          a[l] = s;
        });
      }
      return a;
    })),
    (vc = t(function (a, i, s) {
      var o = i[2];
      return (
        (a[s] = s),
        o.forEach(function (l) {
          a[l] = s;
        }),
        a
      );
    }));
  var n = "far" in zn || U.autoFetchSvg,
    r = ga(
      _h,
      function (a, i) {
        var s = i[0],
          o = i[1],
          l = i[2];
        return (
          o === "far" && !n && (o = "fas"),
          typeof s == "string" && (a.names[s] = { prefix: o, iconName: l }),
          typeof s == "number" &&
            (a.unicodes[s.toString(16)] = { prefix: o, iconName: l }),
          a
        );
      },
      { names: {}, unicodes: {} }
    );
  (pc = r.names), (gc = r.unicodes), (Li = ta(U.styleDefault));
};
oh(function (e) {
  Li = ta(e.styleDefault);
});
bc();
function Di(e, t) {
  return (hc[e] || {})[t];
}
function kh(e, t) {
  return (mc[e] || {})[t];
}
function cn(e, t) {
  return (vc[e] || {})[t];
}
function yc(e) {
  return pc[e] || { prefix: null, iconName: null };
}
function Ah(e) {
  var t = gc[e],
    n = Di("fas", e);
  return (
    t ||
    (n ? { prefix: "fas", iconName: n } : null) || {
      prefix: null,
      iconName: null,
    }
  );
}
function It() {
  return Li;
}
var Fi = function () {
  return { prefix: null, iconName: null, rest: [] };
};
function ta(e) {
  var t = Ni[e],
    n = $r[e] || $r[t],
    r = e in Xe.styles ? e : null;
  return n || r || null;
}
function na(e) {
  var t = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : {},
    n = t.skipLookups,
    r = n === void 0 ? !1 : n,
    a = null,
    i = e.reduce(function (s, o) {
      var l = Ch(U.familyPrefix, o);
      if (
        (zn[o]
          ? ((o = xh.includes(o) ? Xd[o] : o), (a = o), (s.prefix = o))
          : wh.indexOf(o) > -1
          ? ((a = o), (s.prefix = ta(o)))
          : l
          ? (s.iconName = l)
          : o !== U.replacementClass && s.rest.push(o),
        !r && s.prefix && s.iconName)
      ) {
        var f = a === "fa" ? yc(s.iconName) : {},
          c = cn(s.prefix, s.iconName);
        f.prefix && (a = null),
          (s.iconName = f.iconName || c || s.iconName),
          (s.prefix = f.prefix || s.prefix),
          s.prefix === "far" &&
            !zn.far &&
            zn.fas &&
            !U.autoFetchSvg &&
            (s.prefix = "fas");
      }
      return s;
    }, Fi());
  return (i.prefix === "fa" || a === "fa") && (i.prefix = It() || "fas"), i;
}
var Oh = (function () {
    function e() {
      Dd(this, e), (this.definitions = {});
    }
    return (
      Fd(e, [
        {
          key: "add",
          value: function () {
            for (
              var n = this, r = arguments.length, a = new Array(r), i = 0;
              i < r;
              i++
            )
              a[i] = arguments[i];
            var s = a.reduce(this._pullDefinitions, {});
            Object.keys(s).forEach(function (o) {
              (n.definitions[o] = N(N({}, n.definitions[o] || {}), s[o])),
                qa(o, s[o]);
              var l = sc[o];
              l && qa(l, s[o]), bc();
            });
          },
        },
        {
          key: "reset",
          value: function () {
            this.definitions = {};
          },
        },
        {
          key: "_pullDefinitions",
          value: function (n, r) {
            var a = r.prefix && r.iconName && r.icon ? { 0: r } : r;
            return (
              Object.keys(a).map(function (i) {
                var s = a[i],
                  o = s.prefix,
                  l = s.iconName,
                  f = s.icon,
                  c = f[2];
                n[o] || (n[o] = {}),
                  c.length > 0 &&
                    c.forEach(function (u) {
                      typeof u == "string" && (n[o][u] = f);
                    }),
                  (n[o][l] = f);
              }),
              n
            );
          },
        },
      ]),
      e
    );
  })(),
  Xs = [],
  fn = {},
  pn = {},
  Sh = Object.keys(pn);
function Th(e, t) {
  var n = t.mixoutsTo;
  return (
    (Xs = e),
    (fn = {}),
    Object.keys(pn).forEach(function (r) {
      Sh.indexOf(r) === -1 && delete pn[r];
    }),
    Xs.forEach(function (r) {
      var a = r.mixout ? r.mixout() : {};
      if (
        (Object.keys(a).forEach(function (s) {
          typeof a[s] == "function" && (n[s] = a[s]),
            Pr(a[s]) === "object" &&
              Object.keys(a[s]).forEach(function (o) {
                n[s] || (n[s] = {}), (n[s][o] = a[s][o]);
              });
        }),
        r.hooks)
      ) {
        var i = r.hooks();
        Object.keys(i).forEach(function (s) {
          fn[s] || (fn[s] = []), fn[s].push(i[s]);
        });
      }
      r.provides && r.provides(pn);
    }),
    n
  );
}
function Ka(e, t) {
  for (
    var n = arguments.length, r = new Array(n > 2 ? n - 2 : 0), a = 2;
    a < n;
    a++
  )
    r[a - 2] = arguments[a];
  var i = fn[e] || [];
  return (
    i.forEach(function (s) {
      t = s.apply(null, [t].concat(r));
    }),
    t
  );
}
function Jt(e) {
  for (
    var t = arguments.length, n = new Array(t > 1 ? t - 1 : 0), r = 1;
    r < t;
    r++
  )
    n[r - 1] = arguments[r];
  var a = fn[e] || [];
  a.forEach(function (i) {
    i.apply(null, n);
  });
}
function pt() {
  var e = arguments[0],
    t = Array.prototype.slice.call(arguments, 1);
  return pn[e] ? pn[e].apply(null, t) : void 0;
}
function Ya(e) {
  e.prefix === "fa" && (e.prefix = "fas");
  var t = e.iconName,
    n = e.prefix || It();
  if (!!t)
    return (t = cn(n, t) || t), Ys(_c.definitions, n, t) || Ys(Xe.styles, n, t);
}
var _c = new Oh(),
  Ph = function () {
    (U.autoReplaceSvg = !1), (U.observeMutations = !1), Jt("noAuto");
  },
  $h = {
    i2svg: function () {
      var t =
        arguments.length > 0 && arguments[0] !== void 0 ? arguments[0] : {};
      return vt
        ? (Jt("beforeI2svg", t), pt("pseudoElements2svg", t), pt("i2svg", t))
        : Promise.reject("Operation requires a DOM of some kind.");
    },
    watch: function () {
      var t =
          arguments.length > 0 && arguments[0] !== void 0 ? arguments[0] : {},
        n = t.autoReplaceSvgRoot;
      U.autoReplaceSvg === !1 && (U.autoReplaceSvg = !0),
        (U.observeMutations = !0),
        gh(function () {
          Nh({ autoReplaceSvgRoot: n }), Jt("watch", t);
        });
    },
  },
  Rh = {
    icon: function (t) {
      if (t === null) return null;
      if (Pr(t) === "object" && t.prefix && t.iconName)
        return {
          prefix: t.prefix,
          iconName: cn(t.prefix, t.iconName) || t.iconName,
        };
      if (Array.isArray(t) && t.length === 2) {
        var n = t[1].indexOf("fa-") === 0 ? t[1].slice(3) : t[1],
          r = ta(t[0]);
        return { prefix: r, iconName: cn(r, n) || n };
      }
      if (
        typeof t == "string" &&
        (t.indexOf("".concat(U.familyPrefix, "-")) > -1 || t.match(Jd))
      ) {
        var a = na(t.split(" "), { skipLookups: !0 });
        return {
          prefix: a.prefix || It(),
          iconName: cn(a.prefix, a.iconName) || a.iconName,
        };
      }
      if (typeof t == "string") {
        var i = It();
        return { prefix: i, iconName: cn(i, t) || t };
      }
    },
  },
  Be = {
    noAuto: Ph,
    config: U,
    dom: $h,
    parse: Rh,
    library: _c,
    findIconDefinition: Ya,
    toHtml: rr,
  },
  Nh = function () {
    var t = arguments.length > 0 && arguments[0] !== void 0 ? arguments[0] : {},
      n = t.autoReplaceSvgRoot,
      r = n === void 0 ? ge : n;
    (Object.keys(Xe.styles).length > 0 || U.autoFetchSvg) &&
      vt &&
      U.autoReplaceSvg &&
      Be.dom.i2svg({ node: r });
  };
function ra(e, t) {
  return (
    Object.defineProperty(e, "abstract", { get: t }),
    Object.defineProperty(e, "html", {
      get: function () {
        return e.abstract.map(function (r) {
          return rr(r);
        });
      },
    }),
    Object.defineProperty(e, "node", {
      get: function () {
        if (!!vt) {
          var r = ge.createElement("div");
          return (r.innerHTML = e.html), r.children;
        }
      },
    }),
    e
  );
}
function Ih(e) {
  var t = e.children,
    n = e.main,
    r = e.mask,
    a = e.attributes,
    i = e.styles,
    s = e.transform;
  if (Mi(s) && n.found && !r.found) {
    var o = n.width,
      l = n.height,
      f = { x: o / l / 2, y: 0.5 };
    a.style = ea(
      N(
        N({}, i),
        {},
        {
          "transform-origin": ""
            .concat(f.x + s.x / 16, "em ")
            .concat(f.y + s.y / 16, "em"),
        }
      )
    );
  }
  return [{ tag: "svg", attributes: a, children: t }];
}
function Mh(e) {
  var t = e.prefix,
    n = e.iconName,
    r = e.children,
    a = e.attributes,
    i = e.symbol,
    s = i === !0 ? "".concat(t, "-").concat(U.familyPrefix, "-").concat(n) : i;
  return [
    {
      tag: "svg",
      attributes: { style: "display: none;" },
      children: [
        { tag: "symbol", attributes: N(N({}, a), {}, { id: s }), children: r },
      ],
    },
  ];
}
function ji(e) {
  var t = e.icons,
    n = t.main,
    r = t.mask,
    a = e.prefix,
    i = e.iconName,
    s = e.transform,
    o = e.symbol,
    l = e.title,
    f = e.maskId,
    c = e.titleId,
    u = e.extra,
    m = e.watchable,
    g = m === void 0 ? !1 : m,
    E = r.found ? r : n,
    T = E.width,
    A = E.height,
    v = a === "fak",
    y = [U.replacementClass, i ? "".concat(U.familyPrefix, "-").concat(i) : ""]
      .filter(function (G) {
        return u.classes.indexOf(G) === -1;
      })
      .filter(function (G) {
        return G !== "" || !!G;
      })
      .concat(u.classes)
      .join(" "),
    $ = {
      children: [],
      attributes: N(
        N({}, u.attributes),
        {},
        {
          "data-prefix": a,
          "data-icon": i,
          class: y,
          role: u.attributes.role || "img",
          xmlns: "http://www.w3.org/2000/svg",
          viewBox: "0 0 ".concat(T, " ").concat(A),
        }
      ),
    },
    D =
      v && !~u.classes.indexOf("fa-fw")
        ? { width: "".concat((T / A) * 16 * 0.0625, "em") }
        : {};
  g && ($.attributes[Xt] = ""),
    l &&
      ($.children.push({
        tag: "title",
        attributes: {
          id: $.attributes["aria-labelledby"] || "title-".concat(c || er()),
        },
        children: [l],
      }),
      delete $.attributes.title);
  var z = N(
      N({}, $),
      {},
      {
        prefix: a,
        iconName: i,
        main: n,
        mask: r,
        maskId: f,
        transform: s,
        symbol: o,
        styles: N(N({}, D), u.styles),
      }
    ),
    te =
      r.found && n.found
        ? pt("generateAbstractMask", z) || { children: [], attributes: {} }
        : pt("generateAbstractIcon", z) || { children: [], attributes: {} },
    de = te.children,
    W = te.attributes;
  return (z.children = de), (z.attributes = W), o ? Mh(z) : Ih(z);
}
function Js(e) {
  var t = e.content,
    n = e.width,
    r = e.height,
    a = e.transform,
    i = e.title,
    s = e.extra,
    o = e.watchable,
    l = o === void 0 ? !1 : o,
    f = N(
      N(N({}, s.attributes), i ? { title: i } : {}),
      {},
      { class: s.classes.join(" ") }
    );
  l && (f[Xt] = "");
  var c = N({}, s.styles);
  Mi(a) &&
    ((c.transform = dh({
      transform: a,
      startCentered: !0,
      width: n,
      height: r,
    })),
    (c["-webkit-transform"] = c.transform));
  var u = ea(c);
  u.length > 0 && (f.style = u);
  var m = [];
  return (
    m.push({ tag: "span", attributes: f, children: [t] }),
    i &&
      m.push({ tag: "span", attributes: { class: "sr-only" }, children: [i] }),
    m
  );
}
function Lh(e) {
  var t = e.content,
    n = e.title,
    r = e.extra,
    a = N(
      N(N({}, r.attributes), n ? { title: n } : {}),
      {},
      { class: r.classes.join(" ") }
    ),
    i = ea(r.styles);
  i.length > 0 && (a.style = i);
  var s = [];
  return (
    s.push({ tag: "span", attributes: a, children: [t] }),
    n &&
      s.push({ tag: "span", attributes: { class: "sr-only" }, children: [n] }),
    s
  );
}
var va = Xe.styles;
function Ga(e) {
  var t = e[0],
    n = e[1],
    r = e.slice(4),
    a = Ti(r, 1),
    i = a[0],
    s = null;
  return (
    Array.isArray(i)
      ? (s = {
          tag: "g",
          attributes: {
            class: "".concat(U.familyPrefix, "-").concat(Wt.GROUP),
          },
          children: [
            {
              tag: "path",
              attributes: {
                class: "".concat(U.familyPrefix, "-").concat(Wt.SECONDARY),
                fill: "currentColor",
                d: i[0],
              },
            },
            {
              tag: "path",
              attributes: {
                class: "".concat(U.familyPrefix, "-").concat(Wt.PRIMARY),
                fill: "currentColor",
                d: i[1],
              },
            },
          ],
        })
      : (s = { tag: "path", attributes: { fill: "currentColor", d: i } }),
    { found: !0, width: t, height: n, icon: s }
  );
}
var Dh = { found: !1, width: 512, height: 512 };
function Fh(e, t) {
  !ic &&
    !U.showMissingIcons &&
    e &&
    console.error(
      'Icon with name "'.concat(e, '" and prefix "').concat(t, '" is missing.')
    );
}
function Xa(e, t) {
  var n = t;
  return (
    t === "fa" && U.styleDefault !== null && (t = It()),
    new Promise(function (r, a) {
      if ((pt("missingIconAbstract"), n === "fa")) {
        var i = yc(e) || {};
        (e = i.iconName || e), (t = i.prefix || t);
      }
      if (e && t && va[t] && va[t][e]) {
        var s = va[t][e];
        return r(Ga(s));
      }
      Fh(e, t),
        r(
          N(
            N({}, Dh),
            {},
            {
              icon:
                U.showMissingIcons && e ? pt("missingIconAbstract") || {} : {},
            }
          )
        );
    })
  );
}
var Qs = function () {},
  Ja =
    U.measurePerformance && cr && cr.mark && cr.measure
      ? cr
      : { mark: Qs, measure: Qs },
  Mn = 'FA "6.1.1"',
  jh = function (t) {
    return (
      Ja.mark("".concat(Mn, " ").concat(t, " begins")),
      function () {
        return xc(t);
      }
    );
  },
  xc = function (t) {
    Ja.mark("".concat(Mn, " ").concat(t, " ends")),
      Ja.measure(
        "".concat(Mn, " ").concat(t),
        "".concat(Mn, " ").concat(t, " begins"),
        "".concat(Mn, " ").concat(t, " ends")
      );
  },
  Bi = { begin: jh, end: xc },
  br = function () {};
function Zs(e) {
  var t = e.getAttribute ? e.getAttribute(Xt) : null;
  return typeof t == "string";
}
function Bh(e) {
  var t = e.getAttribute ? e.getAttribute($i) : null,
    n = e.getAttribute ? e.getAttribute(Ri) : null;
  return t && n;
}
function Uh(e) {
  return (
    e &&
    e.classList &&
    e.classList.contains &&
    e.classList.contains(U.replacementClass)
  );
}
function zh() {
  if (U.autoReplaceSvg === !0) return yr.replace;
  var e = yr[U.autoReplaceSvg];
  return e || yr.replace;
}
function Hh(e) {
  return ge.createElementNS("http://www.w3.org/2000/svg", e);
}
function Vh(e) {
  return ge.createElement(e);
}
function wc(e) {
  var t = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : {},
    n = t.ceFn,
    r = n === void 0 ? (e.tag === "svg" ? Hh : Vh) : n;
  if (typeof e == "string") return ge.createTextNode(e);
  var a = r(e.tag);
  Object.keys(e.attributes || []).forEach(function (s) {
    a.setAttribute(s, e.attributes[s]);
  });
  var i = e.children || [];
  return (
    i.forEach(function (s) {
      a.appendChild(wc(s, { ceFn: r }));
    }),
    a
  );
}
function Wh(e) {
  var t = " ".concat(e.outerHTML, " ");
  return (t = "".concat(t, "Font Awesome fontawesome.com ")), t;
}
var yr = {
  replace: function (t) {
    var n = t[0];
    if (n.parentNode)
      if (
        (t[1].forEach(function (a) {
          n.parentNode.insertBefore(wc(a), n);
        }),
        n.getAttribute(Xt) === null && U.keepOriginalSource)
      ) {
        var r = ge.createComment(Wh(n));
        n.parentNode.replaceChild(r, n);
      } else n.remove();
  },
  nest: function (t) {
    var n = t[0],
      r = t[1];
    if (~Ii(n).indexOf(U.replacementClass)) return yr.replace(t);
    var a = new RegExp("".concat(U.familyPrefix, "-.*"));
    if ((delete r[0].attributes.id, r[0].attributes.class)) {
      var i = r[0].attributes.class.split(" ").reduce(
        function (o, l) {
          return (
            l === U.replacementClass || l.match(a)
              ? o.toSvg.push(l)
              : o.toNode.push(l),
            o
          );
        },
        { toNode: [], toSvg: [] }
      );
      (r[0].attributes.class = i.toSvg.join(" ")),
        i.toNode.length === 0
          ? n.removeAttribute("class")
          : n.setAttribute("class", i.toNode.join(" "));
    }
    var s = r.map(function (o) {
      return rr(o);
    }).join(`
`);
    n.setAttribute(Xt, ""), (n.innerHTML = s);
  },
};
function eo(e) {
  e();
}
function Ec(e, t) {
  var n = typeof t == "function" ? t : br;
  if (e.length === 0) n();
  else {
    var r = eo;
    U.mutateApproach === Yd && (r = Nt.requestAnimationFrame || eo),
      r(function () {
        var a = zh(),
          i = Bi.begin("mutate");
        e.map(a), i(), n();
      });
  }
}
var Ui = !1;
function Cc() {
  Ui = !0;
}
function Qa() {
  Ui = !1;
}
var Nr = null;
function to(e) {
  if (!!Ws && !!U.observeMutations) {
    var t = e.treeCallback,
      n = t === void 0 ? br : t,
      r = e.nodeCallback,
      a = r === void 0 ? br : r,
      i = e.pseudoElementsCallback,
      s = i === void 0 ? br : i,
      o = e.observeMutationsRoot,
      l = o === void 0 ? ge : o;
    (Nr = new Ws(function (f) {
      if (!Ui) {
        var c = It();
        kn(f).forEach(function (u) {
          if (
            (u.type === "childList" &&
              u.addedNodes.length > 0 &&
              !Zs(u.addedNodes[0]) &&
              (U.searchPseudoElements && s(u.target), n(u.target)),
            u.type === "attributes" &&
              u.target.parentNode &&
              U.searchPseudoElements &&
              s(u.target.parentNode),
            u.type === "attributes" &&
              Zs(u.target) &&
              ~th.indexOf(u.attributeName))
          )
            if (u.attributeName === "class" && Bh(u.target)) {
              var m = na(Ii(u.target)),
                g = m.prefix,
                E = m.iconName;
              u.target.setAttribute($i, g || c),
                E && u.target.setAttribute(Ri, E);
            } else Uh(u.target) && a(u.target);
        });
      }
    })),
      vt &&
        Nr.observe(l, {
          childList: !0,
          attributes: !0,
          characterData: !0,
          subtree: !0,
        });
  }
}
function qh() {
  !Nr || Nr.disconnect();
}
function Kh(e) {
  var t = e.getAttribute("style"),
    n = [];
  return (
    t &&
      (n = t.split(";").reduce(function (r, a) {
        var i = a.split(":"),
          s = i[0],
          o = i.slice(1);
        return s && o.length > 0 && (r[s] = o.join(":").trim()), r;
      }, {})),
    n
  );
}
function Yh(e) {
  var t = e.getAttribute("data-prefix"),
    n = e.getAttribute("data-icon"),
    r = e.innerText !== void 0 ? e.innerText.trim() : "",
    a = na(Ii(e));
  return (
    a.prefix || (a.prefix = It()),
    t && n && ((a.prefix = t), (a.iconName = n)),
    (a.iconName && a.prefix) ||
      (a.prefix &&
        r.length > 0 &&
        (a.iconName =
          kh(a.prefix, e.innerText) || Di(a.prefix, Wa(e.innerText)))),
    a
  );
}
function Gh(e) {
  var t = kn(e.attributes).reduce(function (a, i) {
      return (
        a.name !== "class" && a.name !== "style" && (a[i.name] = i.value), a
      );
    }, {}),
    n = e.getAttribute("title"),
    r = e.getAttribute("data-fa-title-id");
  return (
    U.autoA11y &&
      (n
        ? (t["aria-labelledby"] = ""
            .concat(U.replacementClass, "-title-")
            .concat(r || er()))
        : ((t["aria-hidden"] = "true"), (t.focusable = "false"))),
    t
  );
}
function Xh() {
  return {
    iconName: null,
    title: null,
    titleId: null,
    prefix: null,
    transform: at,
    symbol: !1,
    mask: { iconName: null, prefix: null, rest: [] },
    maskId: null,
    extra: { classes: [], styles: {}, attributes: {} },
  };
}
function no(e) {
  var t =
      arguments.length > 1 && arguments[1] !== void 0
        ? arguments[1]
        : { styleParser: !0 },
    n = Yh(e),
    r = n.iconName,
    a = n.prefix,
    i = n.rest,
    s = Gh(e),
    o = Ka("parseNodeAttributes", {}, e),
    l = t.styleParser ? Kh(e) : [];
  return N(
    {
      iconName: r,
      title: e.getAttribute("title"),
      titleId: e.getAttribute("data-fa-title-id"),
      prefix: a,
      transform: at,
      mask: { iconName: null, prefix: null, rest: [] },
      maskId: null,
      symbol: !1,
      extra: { classes: i, styles: l, attributes: s },
    },
    o
  );
}
var Jh = Xe.styles;
function kc(e) {
  var t = U.autoReplaceSvg === "nest" ? no(e, { styleParser: !1 }) : no(e);
  return ~t.extra.classes.indexOf(oc)
    ? pt("generateLayersText", e, t)
    : pt("generateSvgReplacementMutation", e, t);
}
function ro(e) {
  var t = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : null;
  if (!vt) return Promise.resolve();
  var n = ge.documentElement.classList,
    r = function (u) {
      return n.add("".concat(qs, "-").concat(u));
    },
    a = function (u) {
      return n.remove("".concat(qs, "-").concat(u));
    },
    i = U.autoFetchSvg ? Object.keys(Ni) : Object.keys(Jh),
    s = [".".concat(oc, ":not([").concat(Xt, "])")]
      .concat(
        i.map(function (c) {
          return ".".concat(c, ":not([").concat(Xt, "])");
        })
      )
      .join(", ");
  if (s.length === 0) return Promise.resolve();
  var o = [];
  try {
    o = kn(e.querySelectorAll(s));
  } catch {}
  if (o.length > 0) r("pending"), a("complete");
  else return Promise.resolve();
  var l = Bi.begin("onTree"),
    f = o.reduce(function (c, u) {
      try {
        var m = kc(u);
        m && c.push(m);
      } catch (g) {
        ic || (g.name === "MissingIcon" && console.error(g));
      }
      return c;
    }, []);
  return new Promise(function (c, u) {
    Promise.all(f)
      .then(function (m) {
        Ec(m, function () {
          r("active"),
            r("complete"),
            a("pending"),
            typeof t == "function" && t(),
            l(),
            c();
        });
      })
      .catch(function (m) {
        l(), u(m);
      });
  });
}
function Qh(e) {
  var t = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : null;
  kc(e).then(function (n) {
    n && Ec([n], t);
  });
}
function Zh(e) {
  return function (t) {
    var n = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : {},
      r = (t || {}).icon ? t : Ya(t || {}),
      a = n.mask;
    return (
      a && (a = (a || {}).icon ? a : Ya(a || {})),
      e(r, N(N({}, n), {}, { mask: a }))
    );
  };
}
var em = function (t) {
    var n = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : {},
      r = n.transform,
      a = r === void 0 ? at : r,
      i = n.symbol,
      s = i === void 0 ? !1 : i,
      o = n.mask,
      l = o === void 0 ? null : o,
      f = n.maskId,
      c = f === void 0 ? null : f,
      u = n.title,
      m = u === void 0 ? null : u,
      g = n.titleId,
      E = g === void 0 ? null : g,
      T = n.classes,
      A = T === void 0 ? [] : T,
      v = n.attributes,
      y = v === void 0 ? {} : v,
      $ = n.styles,
      D = $ === void 0 ? {} : $;
    if (!!t) {
      var z = t.prefix,
        te = t.iconName,
        de = t.icon;
      return ra(N({ type: "icon" }, t), function () {
        return (
          Jt("beforeDOMElementCreation", { iconDefinition: t, params: n }),
          U.autoA11y &&
            (m
              ? (y["aria-labelledby"] = ""
                  .concat(U.replacementClass, "-title-")
                  .concat(E || er()))
              : ((y["aria-hidden"] = "true"), (y.focusable = "false"))),
          ji({
            icons: {
              main: Ga(de),
              mask: l
                ? Ga(l.icon)
                : { found: !1, width: null, height: null, icon: {} },
            },
            prefix: z,
            iconName: te,
            transform: N(N({}, at), a),
            symbol: s,
            title: m,
            maskId: c,
            titleId: E,
            extra: { attributes: y, styles: D, classes: A },
          })
        );
      });
    }
  },
  tm = {
    mixout: function () {
      return { icon: Zh(em) };
    },
    hooks: function () {
      return {
        mutationObserverCallbacks: function (n) {
          return (n.treeCallback = ro), (n.nodeCallback = Qh), n;
        },
      };
    },
    provides: function (t) {
      (t.i2svg = function (n) {
        var r = n.node,
          a = r === void 0 ? ge : r,
          i = n.callback,
          s = i === void 0 ? function () {} : i;
        return ro(a, s);
      }),
        (t.generateSvgReplacementMutation = function (n, r) {
          var a = r.iconName,
            i = r.title,
            s = r.titleId,
            o = r.prefix,
            l = r.transform,
            f = r.symbol,
            c = r.mask,
            u = r.maskId,
            m = r.extra;
          return new Promise(function (g, E) {
            Promise.all([
              Xa(a, o),
              c.iconName
                ? Xa(c.iconName, c.prefix)
                : Promise.resolve({
                    found: !1,
                    width: 512,
                    height: 512,
                    icon: {},
                  }),
            ])
              .then(function (T) {
                var A = Ti(T, 2),
                  v = A[0],
                  y = A[1];
                g([
                  n,
                  ji({
                    icons: { main: v, mask: y },
                    prefix: o,
                    iconName: a,
                    transform: l,
                    symbol: f,
                    maskId: u,
                    title: i,
                    titleId: s,
                    extra: m,
                    watchable: !0,
                  }),
                ]);
              })
              .catch(E);
          });
        }),
        (t.generateAbstractIcon = function (n) {
          var r = n.children,
            a = n.attributes,
            i = n.main,
            s = n.transform,
            o = n.styles,
            l = ea(o);
          l.length > 0 && (a.style = l);
          var f;
          return (
            Mi(s) &&
              (f = pt("generateAbstractTransformGrouping", {
                main: i,
                transform: s,
                containerWidth: i.width,
                iconWidth: i.width,
              })),
            r.push(f || i.icon),
            { children: r, attributes: a }
          );
        });
    },
  },
  nm = {
    mixout: function () {
      return {
        layer: function (n) {
          var r =
              arguments.length > 1 && arguments[1] !== void 0
                ? arguments[1]
                : {},
            a = r.classes,
            i = a === void 0 ? [] : a;
          return ra({ type: "layer" }, function () {
            Jt("beforeDOMElementCreation", { assembler: n, params: r });
            var s = [];
            return (
              n(function (o) {
                Array.isArray(o)
                  ? o.map(function (l) {
                      s = s.concat(l.abstract);
                    })
                  : (s = s.concat(o.abstract));
              }),
              [
                {
                  tag: "span",
                  attributes: {
                    class: ["".concat(U.familyPrefix, "-layers")]
                      .concat(Zr(i))
                      .join(" "),
                  },
                  children: s,
                },
              ]
            );
          });
        },
      };
    },
  },
  rm = {
    mixout: function () {
      return {
        counter: function (n) {
          var r =
              arguments.length > 1 && arguments[1] !== void 0
                ? arguments[1]
                : {},
            a = r.title,
            i = a === void 0 ? null : a,
            s = r.classes,
            o = s === void 0 ? [] : s,
            l = r.attributes,
            f = l === void 0 ? {} : l,
            c = r.styles,
            u = c === void 0 ? {} : c;
          return ra({ type: "counter", content: n }, function () {
            return (
              Jt("beforeDOMElementCreation", { content: n, params: r }),
              Lh({
                content: n.toString(),
                title: i,
                extra: {
                  attributes: f,
                  styles: u,
                  classes: [
                    "".concat(U.familyPrefix, "-layers-counter"),
                  ].concat(Zr(o)),
                },
              })
            );
          });
        },
      };
    },
  },
  am = {
    mixout: function () {
      return {
        text: function (n) {
          var r =
              arguments.length > 1 && arguments[1] !== void 0
                ? arguments[1]
                : {},
            a = r.transform,
            i = a === void 0 ? at : a,
            s = r.title,
            o = s === void 0 ? null : s,
            l = r.classes,
            f = l === void 0 ? [] : l,
            c = r.attributes,
            u = c === void 0 ? {} : c,
            m = r.styles,
            g = m === void 0 ? {} : m;
          return ra({ type: "text", content: n }, function () {
            return (
              Jt("beforeDOMElementCreation", { content: n, params: r }),
              Js({
                content: n,
                transform: N(N({}, at), i),
                title: o,
                extra: {
                  attributes: u,
                  styles: g,
                  classes: ["".concat(U.familyPrefix, "-layers-text")].concat(
                    Zr(f)
                  ),
                },
              })
            );
          });
        },
      };
    },
    provides: function (t) {
      t.generateLayersText = function (n, r) {
        var a = r.title,
          i = r.transform,
          s = r.extra,
          o = null,
          l = null;
        if (nc) {
          var f = parseInt(getComputedStyle(n).fontSize, 10),
            c = n.getBoundingClientRect();
          (o = c.width / f), (l = c.height / f);
        }
        return (
          U.autoA11y && !a && (s.attributes["aria-hidden"] = "true"),
          Promise.resolve([
            n,
            Js({
              content: n.innerHTML,
              width: o,
              height: l,
              transform: i,
              title: a,
              extra: s,
              watchable: !0,
            }),
          ])
        );
      };
    },
  },
  im = new RegExp('"', "ug"),
  ao = [1105920, 1112319];
function sm(e) {
  var t = e.replace(im, ""),
    n = yh(t, 0),
    r = n >= ao[0] && n <= ao[1],
    a = t.length === 2 ? t[0] === t[1] : !1;
  return { value: Wa(a ? t[0] : t), isSecondary: r || a };
}
function io(e, t) {
  var n = "".concat(Kd).concat(t.replace(":", "-"));
  return new Promise(function (r, a) {
    if (e.getAttribute(n) !== null) return r();
    var i = kn(e.children),
      s = i.filter(function (te) {
        return te.getAttribute(Va) === t;
      })[0],
      o = Nt.getComputedStyle(e, t),
      l = o.getPropertyValue("font-family").match(Qd),
      f = o.getPropertyValue("font-weight"),
      c = o.getPropertyValue("content");
    if (s && !l) return e.removeChild(s), r();
    if (l && c !== "none" && c !== "") {
      var u = o.getPropertyValue("content"),
        m = ~[
          "Solid",
          "Regular",
          "Light",
          "Thin",
          "Duotone",
          "Brands",
          "Kit",
        ].indexOf(l[2])
          ? $r[l[2].toLowerCase()]
          : Zd[f],
        g = sm(u),
        E = g.value,
        T = g.isSecondary,
        A = l[0].startsWith("FontAwesome"),
        v = Di(m, E),
        y = v;
      if (A) {
        var $ = Ah(E);
        $.iconName && $.prefix && ((v = $.iconName), (m = $.prefix));
      }
      if (
        v &&
        !T &&
        (!s || s.getAttribute($i) !== m || s.getAttribute(Ri) !== y)
      ) {
        e.setAttribute(n, y), s && e.removeChild(s);
        var D = Xh(),
          z = D.extra;
        (z.attributes[Va] = t),
          Xa(v, m)
            .then(function (te) {
              var de = ji(
                  N(
                    N({}, D),
                    {},
                    {
                      icons: { main: te, mask: Fi() },
                      prefix: m,
                      iconName: y,
                      extra: z,
                      watchable: !0,
                    }
                  )
                ),
                W = ge.createElement("svg");
              t === "::before"
                ? e.insertBefore(W, e.firstChild)
                : e.appendChild(W),
                (W.outerHTML = de.map(function (G) {
                  return rr(G);
                }).join(`
`)),
                e.removeAttribute(n),
                r();
            })
            .catch(a);
      } else r();
    } else r();
  });
}
function om(e) {
  return Promise.all([io(e, "::before"), io(e, "::after")]);
}
function lm(e) {
  return (
    e.parentNode !== document.head &&
    !~Gd.indexOf(e.tagName.toUpperCase()) &&
    !e.getAttribute(Va) &&
    (!e.parentNode || e.parentNode.tagName !== "svg")
  );
}
function so(e) {
  if (!!vt)
    return new Promise(function (t, n) {
      var r = kn(e.querySelectorAll("*")).filter(lm).map(om),
        a = Bi.begin("searchPseudoElements");
      Cc(),
        Promise.all(r)
          .then(function () {
            a(), Qa(), t();
          })
          .catch(function () {
            a(), Qa(), n();
          });
    });
}
var cm = {
    hooks: function () {
      return {
        mutationObserverCallbacks: function (n) {
          return (n.pseudoElementsCallback = so), n;
        },
      };
    },
    provides: function (t) {
      t.pseudoElements2svg = function (n) {
        var r = n.node,
          a = r === void 0 ? ge : r;
        U.searchPseudoElements && so(a);
      };
    },
  },
  oo = !1,
  fm = {
    mixout: function () {
      return {
        dom: {
          unwatch: function () {
            Cc(), (oo = !0);
          },
        },
      };
    },
    hooks: function () {
      return {
        bootstrap: function () {
          to(Ka("mutationObserverCallbacks", {}));
        },
        noAuto: function () {
          qh();
        },
        watch: function (n) {
          var r = n.observeMutationsRoot;
          oo
            ? Qa()
            : to(Ka("mutationObserverCallbacks", { observeMutationsRoot: r }));
        },
      };
    },
  },
  lo = function (t) {
    var n = { size: 16, x: 0, y: 0, flipX: !1, flipY: !1, rotate: 0 };
    return t
      .toLowerCase()
      .split(" ")
      .reduce(function (r, a) {
        var i = a.toLowerCase().split("-"),
          s = i[0],
          o = i.slice(1).join("-");
        if (s && o === "h") return (r.flipX = !0), r;
        if (s && o === "v") return (r.flipY = !0), r;
        if (((o = parseFloat(o)), isNaN(o))) return r;
        switch (s) {
          case "grow":
            r.size = r.size + o;
            break;
          case "shrink":
            r.size = r.size - o;
            break;
          case "left":
            r.x = r.x - o;
            break;
          case "right":
            r.x = r.x + o;
            break;
          case "up":
            r.y = r.y - o;
            break;
          case "down":
            r.y = r.y + o;
            break;
          case "rotate":
            r.rotate = r.rotate + o;
            break;
        }
        return r;
      }, n);
  },
  um = {
    mixout: function () {
      return {
        parse: {
          transform: function (n) {
            return lo(n);
          },
        },
      };
    },
    hooks: function () {
      return {
        parseNodeAttributes: function (n, r) {
          var a = r.getAttribute("data-fa-transform");
          return a && (n.transform = lo(a)), n;
        },
      };
    },
    provides: function (t) {
      t.generateAbstractTransformGrouping = function (n) {
        var r = n.main,
          a = n.transform,
          i = n.containerWidth,
          s = n.iconWidth,
          o = { transform: "translate(".concat(i / 2, " 256)") },
          l = "translate(".concat(a.x * 32, ", ").concat(a.y * 32, ") "),
          f = "scale("
            .concat((a.size / 16) * (a.flipX ? -1 : 1), ", ")
            .concat((a.size / 16) * (a.flipY ? -1 : 1), ") "),
          c = "rotate(".concat(a.rotate, " 0 0)"),
          u = { transform: "".concat(l, " ").concat(f, " ").concat(c) },
          m = { transform: "translate(".concat((s / 2) * -1, " -256)") },
          g = { outer: o, inner: u, path: m };
        return {
          tag: "g",
          attributes: N({}, g.outer),
          children: [
            {
              tag: "g",
              attributes: N({}, g.inner),
              children: [
                {
                  tag: r.icon.tag,
                  children: r.icon.children,
                  attributes: N(N({}, r.icon.attributes), g.path),
                },
              ],
            },
          ],
        };
      };
    },
  },
  ba = { x: 0, y: 0, width: "100%", height: "100%" };
function co(e) {
  var t = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : !0;
  return (
    e.attributes && (e.attributes.fill || t) && (e.attributes.fill = "black"), e
  );
}
function dm(e) {
  return e.tag === "g" ? e.children : [e];
}
var hm = {
    hooks: function () {
      return {
        parseNodeAttributes: function (n, r) {
          var a = r.getAttribute("data-fa-mask"),
            i = a
              ? na(
                  a.split(" ").map(function (s) {
                    return s.trim();
                  })
                )
              : Fi();
          return (
            i.prefix || (i.prefix = It()),
            (n.mask = i),
            (n.maskId = r.getAttribute("data-fa-mask-id")),
            n
          );
        },
      };
    },
    provides: function (t) {
      t.generateAbstractMask = function (n) {
        var r = n.children,
          a = n.attributes,
          i = n.main,
          s = n.mask,
          o = n.maskId,
          l = n.transform,
          f = i.width,
          c = i.icon,
          u = s.width,
          m = s.icon,
          g = uh({ transform: l, containerWidth: u, iconWidth: f }),
          E = { tag: "rect", attributes: N(N({}, ba), {}, { fill: "white" }) },
          T = c.children ? { children: c.children.map(co) } : {},
          A = {
            tag: "g",
            attributes: N({}, g.inner),
            children: [
              co(
                N({ tag: c.tag, attributes: N(N({}, c.attributes), g.path) }, T)
              ),
            ],
          },
          v = { tag: "g", attributes: N({}, g.outer), children: [A] },
          y = "mask-".concat(o || er()),
          $ = "clip-".concat(o || er()),
          D = {
            tag: "mask",
            attributes: N(
              N({}, ba),
              {},
              {
                id: y,
                maskUnits: "userSpaceOnUse",
                maskContentUnits: "userSpaceOnUse",
              }
            ),
            children: [E, v],
          },
          z = {
            tag: "defs",
            children: [
              { tag: "clipPath", attributes: { id: $ }, children: dm(m) },
              D,
            ],
          };
        return (
          r.push(z, {
            tag: "rect",
            attributes: N(
              {
                fill: "currentColor",
                "clip-path": "url(#".concat($, ")"),
                mask: "url(#".concat(y, ")"),
              },
              ba
            ),
          }),
          { children: r, attributes: a }
        );
      };
    },
  },
  mm = {
    provides: function (t) {
      var n = !1;
      Nt.matchMedia &&
        (n = Nt.matchMedia("(prefers-reduced-motion: reduce)").matches),
        (t.missingIconAbstract = function () {
          var r = [],
            a = { fill: "currentColor" },
            i = { attributeType: "XML", repeatCount: "indefinite", dur: "2s" };
          r.push({
            tag: "path",
            attributes: N(
              N({}, a),
              {},
              {
                d: "M156.5,447.7l-12.6,29.5c-18.7-9.5-35.9-21.2-51.5-34.9l22.7-22.7C127.6,430.5,141.5,440,156.5,447.7z M40.6,272H8.5 c1.4,21.2,5.4,41.7,11.7,61.1L50,321.2C45.1,305.5,41.8,289,40.6,272z M40.6,240c1.4-18.8,5.2-37,11.1-54.1l-29.5-12.6 C14.7,194.3,10,216.7,8.5,240H40.6z M64.3,156.5c7.8-14.9,17.2-28.8,28.1-41.5L69.7,92.3c-13.7,15.6-25.5,32.8-34.9,51.5 L64.3,156.5z M397,419.6c-13.9,12-29.4,22.3-46.1,30.4l11.9,29.8c20.7-9.9,39.8-22.6,56.9-37.6L397,419.6z M115,92.4 c13.9-12,29.4-22.3,46.1-30.4l-11.9-29.8c-20.7,9.9-39.8,22.6-56.8,37.6L115,92.4z M447.7,355.5c-7.8,14.9-17.2,28.8-28.1,41.5 l22.7,22.7c13.7-15.6,25.5-32.9,34.9-51.5L447.7,355.5z M471.4,272c-1.4,18.8-5.2,37-11.1,54.1l29.5,12.6 c7.5-21.1,12.2-43.5,13.6-66.8H471.4z M321.2,462c-15.7,5-32.2,8.2-49.2,9.4v32.1c21.2-1.4,41.7-5.4,61.1-11.7L321.2,462z M240,471.4c-18.8-1.4-37-5.2-54.1-11.1l-12.6,29.5c21.1,7.5,43.5,12.2,66.8,13.6V471.4z M462,190.8c5,15.7,8.2,32.2,9.4,49.2h32.1 c-1.4-21.2-5.4-41.7-11.7-61.1L462,190.8z M92.4,397c-12-13.9-22.3-29.4-30.4-46.1l-29.8,11.9c9.9,20.7,22.6,39.8,37.6,56.9 L92.4,397z M272,40.6c18.8,1.4,36.9,5.2,54.1,11.1l12.6-29.5C317.7,14.7,295.3,10,272,8.5V40.6z M190.8,50 c15.7-5,32.2-8.2,49.2-9.4V8.5c-21.2,1.4-41.7,5.4-61.1,11.7L190.8,50z M442.3,92.3L419.6,115c12,13.9,22.3,29.4,30.5,46.1 l29.8-11.9C470,128.5,457.3,109.4,442.3,92.3z M397,92.4l22.7-22.7c-15.6-13.7-32.8-25.5-51.5-34.9l-12.6,29.5 C370.4,72.1,384.4,81.5,397,92.4z",
              }
            ),
          });
          var s = N(N({}, i), {}, { attributeName: "opacity" }),
            o = {
              tag: "circle",
              attributes: N(N({}, a), {}, { cx: "256", cy: "364", r: "28" }),
              children: [],
            };
          return (
            n ||
              o.children.push(
                {
                  tag: "animate",
                  attributes: N(
                    N({}, i),
                    {},
                    { attributeName: "r", values: "28;14;28;28;14;28;" }
                  ),
                },
                {
                  tag: "animate",
                  attributes: N(N({}, s), {}, { values: "1;0;1;1;0;1;" }),
                }
              ),
            r.push(o),
            r.push({
              tag: "path",
              attributes: N(
                N({}, a),
                {},
                {
                  opacity: "1",
                  d: "M263.7,312h-16c-6.6,0-12-5.4-12-12c0-71,77.4-63.9,77.4-107.8c0-20-17.8-40.2-57.4-40.2c-29.1,0-44.3,9.6-59.2,28.7 c-3.9,5-11.1,6-16.2,2.4l-13.1-9.2c-5.6-3.9-6.9-11.8-2.6-17.2c21.2-27.2,46.4-44.7,91.2-44.7c52.3,0,97.4,29.8,97.4,80.2 c0,67.6-77.4,63.5-77.4,107.8C275.7,306.6,270.3,312,263.7,312z",
                }
              ),
              children: n
                ? []
                : [
                    {
                      tag: "animate",
                      attributes: N(N({}, s), {}, { values: "1;0;0;0;0;1;" }),
                    },
                  ],
            }),
            n ||
              r.push({
                tag: "path",
                attributes: N(
                  N({}, a),
                  {},
                  {
                    opacity: "0",
                    d: "M232.5,134.5l7,168c0.3,6.4,5.6,11.5,12,11.5h9c6.4,0,11.7-5.1,12-11.5l7-168c0.3-6.8-5.2-12.5-12-12.5h-23 C237.7,122,232.2,127.7,232.5,134.5z",
                  }
                ),
                children: [
                  {
                    tag: "animate",
                    attributes: N(N({}, s), {}, { values: "0;0;1;1;0;0;" }),
                  },
                ],
              }),
            { tag: "g", attributes: { class: "missing" }, children: r }
          );
        });
    },
  },
  pm = {
    hooks: function () {
      return {
        parseNodeAttributes: function (n, r) {
          var a = r.getAttribute("data-fa-symbol"),
            i = a === null ? !1 : a === "" ? !0 : a;
          return (n.symbol = i), n;
        },
      };
    },
  },
  gm = [mh, tm, nm, rm, am, cm, fm, um, hm, mm, pm];
Th(gm, { mixoutsTo: Be });
Be.noAuto;
var Ac = Be.config,
  vm = Be.library;
Be.dom;
var Ir = Be.parse;
Be.findIconDefinition;
Be.toHtml;
var bm = Be.icon;
Be.layer;
var ym = Be.text;
Be.counter;
function fo(e, t) {
  var n = Object.keys(e);
  if (Object.getOwnPropertySymbols) {
    var r = Object.getOwnPropertySymbols(e);
    t &&
      (r = r.filter(function (a) {
        return Object.getOwnPropertyDescriptor(e, a).enumerable;
      })),
      n.push.apply(n, r);
  }
  return n;
}
function Ye(e) {
  for (var t = 1; t < arguments.length; t++) {
    var n = arguments[t] != null ? arguments[t] : {};
    t % 2
      ? fo(Object(n), !0).forEach(function (r) {
          Re(e, r, n[r]);
        })
      : Object.getOwnPropertyDescriptors
      ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
      : fo(Object(n)).forEach(function (r) {
          Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(n, r));
        });
  }
  return e;
}
function Mr(e) {
  return (
    (Mr =
      typeof Symbol == "function" && typeof Symbol.iterator == "symbol"
        ? function (t) {
            return typeof t;
          }
        : function (t) {
            return t &&
              typeof Symbol == "function" &&
              t.constructor === Symbol &&
              t !== Symbol.prototype
              ? "symbol"
              : typeof t;
          }),
    Mr(e)
  );
}
function Re(e, t, n) {
  return (
    t in e
      ? Object.defineProperty(e, t, {
          value: n,
          enumerable: !0,
          configurable: !0,
          writable: !0,
        })
      : (e[t] = n),
    e
  );
}
function _m(e, t) {
  if (e == null) return {};
  var n = {},
    r = Object.keys(e),
    a,
    i;
  for (i = 0; i < r.length; i++)
    (a = r[i]), !(t.indexOf(a) >= 0) && (n[a] = e[a]);
  return n;
}
function xm(e, t) {
  if (e == null) return {};
  var n = _m(e, t),
    r,
    a;
  if (Object.getOwnPropertySymbols) {
    var i = Object.getOwnPropertySymbols(e);
    for (a = 0; a < i.length; a++)
      (r = i[a]),
        !(t.indexOf(r) >= 0) &&
          (!Object.prototype.propertyIsEnumerable.call(e, r) || (n[r] = e[r]));
  }
  return n;
}
function Za(e) {
  return wm(e) || Em(e) || Cm(e) || km();
}
function wm(e) {
  if (Array.isArray(e)) return ei(e);
}
function Em(e) {
  if (
    (typeof Symbol != "undefined" && e[Symbol.iterator] != null) ||
    e["@@iterator"] != null
  )
    return Array.from(e);
}
function Cm(e, t) {
  if (!!e) {
    if (typeof e == "string") return ei(e, t);
    var n = Object.prototype.toString.call(e).slice(8, -1);
    if (
      (n === "Object" && e.constructor && (n = e.constructor.name),
      n === "Map" || n === "Set")
    )
      return Array.from(e);
    if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))
      return ei(e, t);
  }
}
function ei(e, t) {
  (t == null || t > e.length) && (t = e.length);
  for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
  return r;
}
function km() {
  throw new TypeError(`Invalid attempt to spread non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`);
}
var Am =
    typeof globalThis != "undefined"
      ? globalThis
      : typeof window != "undefined"
      ? window
      : typeof global != "undefined"
      ? global
      : typeof self != "undefined"
      ? self
      : {},
  Oc = { exports: {} };
(function (e) {
  (function (t) {
    var n = function (v, y, $) {
        if (!f(y) || u(y) || m(y) || g(y) || l(y)) return y;
        var D,
          z = 0,
          te = 0;
        if (c(y))
          for (D = [], te = y.length; z < te; z++) D.push(n(v, y[z], $));
        else {
          D = {};
          for (var de in y)
            Object.prototype.hasOwnProperty.call(y, de) &&
              (D[v(de, $)] = n(v, y[de], $));
        }
        return D;
      },
      r = function (v, y) {
        y = y || {};
        var $ = y.separator || "_",
          D = y.split || /(?=[A-Z])/;
        return v.split(D).join($);
      },
      a = function (v) {
        return E(v)
          ? v
          : ((v = v.replace(/[\-_\s]+(.)?/g, function (y, $) {
              return $ ? $.toUpperCase() : "";
            })),
            v.substr(0, 1).toLowerCase() + v.substr(1));
      },
      i = function (v) {
        var y = a(v);
        return y.substr(0, 1).toUpperCase() + y.substr(1);
      },
      s = function (v, y) {
        return r(v, y).toLowerCase();
      },
      o = Object.prototype.toString,
      l = function (v) {
        return typeof v == "function";
      },
      f = function (v) {
        return v === Object(v);
      },
      c = function (v) {
        return o.call(v) == "[object Array]";
      },
      u = function (v) {
        return o.call(v) == "[object Date]";
      },
      m = function (v) {
        return o.call(v) == "[object RegExp]";
      },
      g = function (v) {
        return o.call(v) == "[object Boolean]";
      },
      E = function (v) {
        return (v = v - 0), v === v;
      },
      T = function (v, y) {
        var $ = y && "process" in y ? y.process : y;
        return typeof $ != "function"
          ? v
          : function (D, z) {
              return $(D, v, z);
            };
      },
      A = {
        camelize: a,
        decamelize: s,
        pascalize: i,
        depascalize: s,
        camelizeKeys: function (v, y) {
          return n(T(a, y), v);
        },
        decamelizeKeys: function (v, y) {
          return n(T(s, y), v, y);
        },
        pascalizeKeys: function (v, y) {
          return n(T(i, y), v);
        },
        depascalizeKeys: function () {
          return this.decamelizeKeys.apply(this, arguments);
        },
      };
    e.exports ? (e.exports = A) : (t.humps = A);
  })(Am);
})(Oc);
var Om = Oc.exports,
  Sm = ["class", "style"];
function Tm(e) {
  return e
    .split(";")
    .map(function (t) {
      return t.trim();
    })
    .filter(function (t) {
      return t;
    })
    .reduce(function (t, n) {
      var r = n.indexOf(":"),
        a = Om.camelize(n.slice(0, r)),
        i = n.slice(r + 1).trim();
      return (t[a] = i), t;
    }, {});
}
function Pm(e) {
  return e.split(/\s+/).reduce(function (t, n) {
    return (t[n] = !0), t;
  }, {});
}
function zi(e) {
  var t = arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : {},
    n = arguments.length > 2 && arguments[2] !== void 0 ? arguments[2] : {};
  if (typeof e == "string") return e;
  var r = (e.children || []).map(function (l) {
      return zi(l);
    }),
    a = Object.keys(e.attributes || {}).reduce(
      function (l, f) {
        var c = e.attributes[f];
        switch (f) {
          case "class":
            l.class = Pm(c);
            break;
          case "style":
            l.style = Tm(c);
            break;
          default:
            l.attrs[f] = c;
        }
        return l;
      },
      { attrs: {}, class: {}, style: {} }
    );
  n.class;
  var i = n.style,
    s = i === void 0 ? {} : i,
    o = xm(n, Sm);
  return Qr(
    e.tag,
    Ye(
      Ye(
        Ye({}, t),
        {},
        { class: a.class, style: Ye(Ye({}, a.style), s) },
        a.attrs
      ),
      o
    ),
    r
  );
}
var Sc = !1;
try {
  Sc = !0;
} catch {}
function $m() {
  if (!Sc && console && typeof console.error == "function") {
    var e;
    (e = console).error.apply(e, arguments);
  }
}
function Hn(e, t) {
  return (Array.isArray(t) && t.length > 0) || (!Array.isArray(t) && t)
    ? Re({}, e, t)
    : {};
}
function Rm(e) {
  var t,
    n =
      ((t = {
        "fa-spin": e.spin,
        "fa-pulse": e.pulse,
        "fa-fw": e.fixedWidth,
        "fa-border": e.border,
        "fa-li": e.listItem,
        "fa-inverse": e.inverse,
        "fa-flip": e.flip === !0,
        "fa-flip-horizontal": e.flip === "horizontal" || e.flip === "both",
        "fa-flip-vertical": e.flip === "vertical" || e.flip === "both",
      }),
      Re(t, "fa-".concat(e.size), e.size !== null),
      Re(t, "fa-rotate-".concat(e.rotation), e.rotation !== null),
      Re(t, "fa-pull-".concat(e.pull), e.pull !== null),
      Re(t, "fa-swap-opacity", e.swapOpacity),
      Re(t, "fa-bounce", e.bounce),
      Re(t, "fa-shake", e.shake),
      Re(t, "fa-beat", e.beat),
      Re(t, "fa-fade", e.fade),
      Re(t, "fa-beat-fade", e.beatFade),
      Re(t, "fa-flash", e.flash),
      Re(t, "fa-spin-pulse", e.spinPulse),
      Re(t, "fa-spin-reverse", e.spinReverse),
      t);
  return Object.keys(n)
    .map(function (r) {
      return n[r] ? r : null;
    })
    .filter(function (r) {
      return r;
    });
}
function uo(e) {
  if (e && Mr(e) === "object" && e.prefix && e.iconName && e.icon) return e;
  if (Ir.icon) return Ir.icon(e);
  if (e === null) return null;
  if (Mr(e) === "object" && e.prefix && e.iconName) return e;
  if (Array.isArray(e) && e.length === 2)
    return { prefix: e[0], iconName: e[1] };
  if (typeof e == "string") return { prefix: "fas", iconName: e };
}
var Nm = Mt({
  name: "FontAwesomeIcon",
  props: {
    border: { type: Boolean, default: !1 },
    fixedWidth: { type: Boolean, default: !1 },
    flip: {
      type: [Boolean, String],
      default: !1,
      validator: function (t) {
        return [!0, !1, "horizontal", "vertical", "both"].indexOf(t) > -1;
      },
    },
    icon: { type: [Object, Array, String], required: !0 },
    mask: { type: [Object, Array, String], default: null },
    listItem: { type: Boolean, default: !1 },
    pull: {
      type: String,
      default: null,
      validator: function (t) {
        return ["right", "left"].indexOf(t) > -1;
      },
    },
    pulse: { type: Boolean, default: !1 },
    rotation: {
      type: [String, Number],
      default: null,
      validator: function (t) {
        return [90, 180, 270].indexOf(Number.parseInt(t, 10)) > -1;
      },
    },
    swapOpacity: { type: Boolean, default: !1 },
    size: {
      type: String,
      default: null,
      validator: function (t) {
        return (
          [
            "2xs",
            "xs",
            "sm",
            "lg",
            "xl",
            "2xl",
            "1x",
            "2x",
            "3x",
            "4x",
            "5x",
            "6x",
            "7x",
            "8x",
            "9x",
            "10x",
          ].indexOf(t) > -1
        );
      },
    },
    spin: { type: Boolean, default: !1 },
    transform: { type: [String, Object], default: null },
    symbol: { type: [Boolean, String], default: !1 },
    title: { type: String, default: null },
    inverse: { type: Boolean, default: !1 },
    bounce: { type: Boolean, default: !1 },
    shake: { type: Boolean, default: !1 },
    beat: { type: Boolean, default: !1 },
    fade: { type: Boolean, default: !1 },
    beatFade: { type: Boolean, default: !1 },
    flash: { type: Boolean, default: !1 },
    spinPulse: { type: Boolean, default: !1 },
    spinReverse: { type: Boolean, default: !1 },
  },
  setup: function (t, n) {
    var r = n.attrs,
      a = ve(function () {
        return uo(t.icon);
      }),
      i = ve(function () {
        return Hn("classes", Rm(t));
      }),
      s = ve(function () {
        return Hn(
          "transform",
          typeof t.transform == "string"
            ? Ir.transform(t.transform)
            : t.transform
        );
      }),
      o = ve(function () {
        return Hn("mask", uo(t.mask));
      }),
      l = ve(function () {
        return bm(
          a.value,
          Ye(
            Ye(Ye(Ye({}, i.value), s.value), o.value),
            {},
            { symbol: t.symbol, title: t.title }
          )
        );
      });
    Fn(
      l,
      function (c) {
        if (!c)
          return $m("Could not find one or more icon(s)", a.value, o.value);
      },
      { immediate: !0 }
    );
    var f = ve(function () {
      return l.value ? zi(l.value.abstract[0], {}, r) : null;
    });
    return function () {
      return f.value;
    };
  },
});
Mt({
  name: "FontAwesomeLayers",
  props: { fixedWidth: { type: Boolean, default: !1 } },
  setup: function (t, n) {
    var r = n.slots,
      a = Ac.familyPrefix,
      i = ve(function () {
        return ["".concat(a, "-layers")].concat(
          Za(t.fixedWidth ? ["".concat(a, "-fw")] : [])
        );
      });
    return function () {
      return Qr("div", { class: i.value }, r.default ? r.default() : []);
    };
  },
});
Mt({
  name: "FontAwesomeLayersText",
  props: {
    value: { type: [String, Number], default: "" },
    transform: { type: [String, Object], default: null },
    counter: { type: Boolean, default: !1 },
    position: {
      type: String,
      default: null,
      validator: function (t) {
        return (
          ["bottom-left", "bottom-right", "top-left", "top-right"].indexOf(t) >
          -1
        );
      },
    },
  },
  setup: function (t, n) {
    var r = n.attrs,
      a = Ac.familyPrefix,
      i = ve(function () {
        return Hn(
          "classes",
          [].concat(
            Za(t.counter ? ["".concat(a, "-layers-counter")] : []),
            Za(t.position ? ["".concat(a, "-layers-").concat(t.position)] : [])
          )
        );
      }),
      s = ve(function () {
        return Hn(
          "transform",
          typeof t.transform == "string"
            ? Ir.transform(t.transform)
            : t.transform
        );
      }),
      o = ve(function () {
        var f = ym(t.value.toString(), Ye(Ye({}, s.value), i.value)),
          c = f.abstract;
        return (
          t.counter &&
            (c[0].attributes.class = c[0].attributes.class.replace(
              "fa-layers-text",
              ""
            )),
          c[0]
        );
      }),
      l = ve(function () {
        return zi(o.value, {}, r);
      });
    return function () {
      return l.value;
    };
  },
});
/*!
 * Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com
 * License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
 * Copyright 2022 Fonticons, Inc.
 */ var Im = {
  prefix: "fas",
  iconName: "clipboard",
  icon: [
    384,
    512,
    [128203],
    "f328",
    "M336 64h-53.88C268.9 26.8 233.7 0 192 0S115.1 26.8 101.9 64H48C21.5 64 0 85.48 0 112v352C0 490.5 21.5 512 48 512h288c26.5 0 48-21.48 48-48v-352C384 85.48 362.5 64 336 64zM192 64c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S160 113.7 160 96C160 78.33 174.3 64 192 64zM272 224h-160C103.2 224 96 216.8 96 208C96 199.2 103.2 192 112 192h160C280.8 192 288 199.2 288 208S280.8 224 272 224z",
  ],
};
function Mm(e) {
  return {
    all: (e = e || new Map()),
    on: function (t, n) {
      var r = e.get(t);
      r ? r.push(n) : e.set(t, [n]);
    },
    off: function (t, n) {
      var r = e.get(t);
      r && (n ? r.splice(r.indexOf(n) >>> 0, 1) : e.set(t, []));
    },
    emit: function (t, n) {
      var r = e.get(t);
      r &&
        r.slice().map(function (a) {
          a(n);
        }),
        (r = e.get("*")) &&
          r.slice().map(function (a) {
            a(t, n);
          });
    },
  };
}
const Lr = Mm(),
  Tc = new Map(),
  ho = { x: ["left", "center", "right"], y: ["top", "bottom"] },
  Lm = (
    (e) => () =>
      e++
  )(0),
  Dm = (e) => (typeof e != "string" ? [] : e.split(/\s+/gi).filter((t) => t)),
  Fm = (e) => {
    typeof e == "string" && (e = Dm(e));
    let t = null,
      n = null;
    return (
      e.forEach((r) => {
        ho.y.indexOf(r) !== -1 && (n = r), ho.x.indexOf(r) !== -1 && (t = r);
      }),
      { x: t, y: n }
    );
  };
class jm {
  constructor(t, n, r) {
    (this.remaining = n),
      (this.callback = t),
      (this.notifyItem = r),
      this.resume();
  }
  pause() {
    clearTimeout(this.notifyItem.timer),
      (this.remaining -= Date.now() - this.start);
  }
  resume() {
    (this.start = Date.now()),
      clearTimeout(this.notifyItem.timer),
      (this.notifyItem.timer = setTimeout(this.callback, this.remaining));
  }
}
var ya = {
    position: ["top", "right"],
    cssAnimation: "vn-fade",
    velocityAnimation: {
      enter: (e) => ({ height: [e.clientHeight, 0], opacity: [1, 0] }),
      leave: { height: 0, opacity: [0, 1] },
    },
  },
  Hi = Mt({
    name: "velocity-group",
    emits: ["after-leave", "leave", "enter"],
    methods: {
      enter(e, t) {
        this.$emit("enter", { el: e, complete: t });
      },
      leave(e, t) {
        this.$emit("leave", { el: e, complete: t });
      },
      afterLeave() {
        this.$emit("after-leave");
      },
    },
  });
function Bm(e, t, n, r, a, i) {
  return (
    J(),
    ut(
      Jl,
      {
        tag: "span",
        css: !1,
        onEnter: e.enter,
        onLeave: e.leave,
        onAfterLeave: e.afterLeave,
      },
      { default: Gt(() => [Ci(e.$slots, "default")]), _: 3 },
      8,
      ["onEnter", "onLeave", "onAfterLeave"]
    )
  );
}
Hi.render = Bm;
Hi.__file = "src/VelocityGroup.vue";
var Vi = Mt({
  name: "css-group",
  inheritAttrs: !1,
  props: { name: { type: String, required: !0 } },
});
function Um(e, t, n, r, a, i) {
  return (
    J(),
    ut(
      Jl,
      { tag: "span", name: e.name },
      { default: Gt(() => [Ci(e.$slots, "default")]), _: 3 },
      8,
      ["name"]
    )
  );
}
Vi.render = Um;
Vi.__file = "src/CssGroup.vue";
const _a = "[-+]?[0-9]*.?[0-9]+",
  mo = [
    { name: "px", regexp: new RegExp(`^${_a}px$`) },
    { name: "%", regexp: new RegExp(`^${_a}%$`) },
    { name: "px", regexp: new RegExp(`^${_a}$`) },
  ],
  zm = (e) => {
    if (e === "auto") return { type: e, value: 0 };
    for (let t = 0; t < mo.length; t++) {
      const n = mo[t];
      if (n.regexp.test(e)) return { type: n.name, value: parseFloat(e) };
    }
    return { type: "", value: e };
  },
  Hm = (e) => {
    switch (typeof e) {
      case "number":
        return { type: "px", value: e };
      case "string":
        return zm(e);
      default:
        return { type: "", value: e };
    }
  },
  fr = { IDLE: 0, DESTROYED: 2 };
var Wi = Mt({
  name: "notifications",
  components: { VelocityGroup: Hi, CssGroup: Vi },
  props: {
    group: { type: String, default: "" },
    width: { type: [Number, String], default: 300 },
    reverse: { type: Boolean, default: !1 },
    position: { type: [String, Array], default: ya.position },
    classes: { type: String, default: "vue-notification" },
    animationType: { type: String, default: "css" },
    animation: { type: Object, default: ya.velocityAnimation },
    animationName: { type: String, default: ya.cssAnimation },
    speed: { type: Number, default: 300 },
    cooldown: { type: Number, default: 0 },
    duration: { type: Number, default: 3e3 },
    delay: { type: Number, default: 0 },
    max: { type: Number, default: 1 / 0 },
    ignoreDuplicates: { type: Boolean, default: !1 },
    closeOnClick: { type: Boolean, default: !0 },
    pauseOnHover: { type: Boolean, default: !1 },
  },
  emits: ["click", "destroy"],
  data() {
    return { list: [], velocity: Tc.get("velocity"), timerControl: null };
  },
  computed: {
    actualWidth() {
      return Hm(this.width);
    },
    isVA() {
      return this.animationType === "velocity";
    },
    componentName() {
      return this.isVA ? "velocity-group" : "css-group";
    },
    styles() {
      const { x: e, y: t } = Fm(this.position),
        n = this.actualWidth.value,
        r = this.actualWidth.type,
        a = { width: n + r };
      return (
        t && (a[t] = "0px"),
        e &&
          (e === "center"
            ? (a.left = `calc(50% - ${+n / 2}${r})`)
            : (a[e] = "0px")),
        a
      );
    },
    active() {
      return this.list.filter((e) => e.state !== fr.DESTROYED);
    },
    botToTop() {
      return this.styles.hasOwnProperty("bottom");
    },
  },
  mounted() {
    Lr.on("add", this.addItem), Lr.on("close", this.closeItem);
  },
  methods: {
    destroyIfNecessary(e) {
      this.$emit("click", e), this.closeOnClick && this.destroy(e);
    },
    pauseTimeout() {
      var e;
      this.pauseOnHover &&
        ((e = this.timerControl) === null || e === void 0 || e.pause());
    },
    resumeTimeout() {
      var e;
      this.pauseOnHover &&
        ((e = this.timerControl) === null || e === void 0 || e.resume());
    },
    addItem(e = {}) {
      if (
        (e.group || (e.group = ""),
        e.data || (e.data = {}),
        this.group !== e.group)
      )
        return;
      if (e.clean || e.clear) {
        this.destroyAll();
        return;
      }
      const t = typeof e.duration == "number" ? e.duration : this.duration,
        n = typeof e.speed == "number" ? e.speed : this.speed,
        r =
          typeof e.ignoreDuplicates == "boolean"
            ? e.ignoreDuplicates
            : this.ignoreDuplicates,
        { title: a, text: i, type: s, data: o, id: l } = e,
        f = {
          id: l || Lm(),
          title: a,
          text: i,
          type: s,
          state: fr.IDLE,
          speed: n,
          length: t + 2 * n,
          data: o,
        };
      t >= 0 &&
        (this.timerControl = new jm(() => this.destroy(f), f.length, f));
      const c = this.reverse ? !this.botToTop : this.botToTop;
      let u = -1;
      const m = this.active.some(
        (E) => E.title === e.title && E.text === e.text
      );
      (!r || !m) &&
        (c
          ? (this.list.push(f), this.active.length > this.max && (u = 0))
          : (this.list.unshift(f),
            this.active.length > this.max && (u = this.active.length - 1)),
        u !== -1 && this.destroy(this.active[u]));
    },
    closeItem(e) {
      this.destroyById(e);
    },
    notifyClass(e) {
      var t;
      return [
        "vue-notification-template",
        this.classes,
        (t = e.type) !== null && t !== void 0 ? t : "",
      ];
    },
    notifyWrapperStyle(e) {
      return this.isVA ? void 0 : { transition: `all ${e.speed}ms` };
    },
    destroy(e) {
      clearTimeout(e.timer),
        (e.state = fr.DESTROYED),
        this.isVA || this.clean(),
        this.$emit("destroy", e);
    },
    destroyById(e) {
      const t = this.list.find((n) => n.id === e);
      t && this.destroy(t);
    },
    destroyAll() {
      this.active.forEach(this.destroy);
    },
    getAnimation(e, t) {
      var n;
      const r = (n = this.animation) === null || n === void 0 ? void 0 : n[e];
      return typeof r == "function" ? r.call(this, t) : r;
    },
    enter(e, t) {
      if (!this.isVA) return;
      const n = this.getAnimation("enter", e);
      this.velocity(e, n, { duration: this.speed, complete: t });
    },
    leave(e, t) {
      if (!this.isVA) return;
      const n = this.getAnimation("leave", e);
      this.velocity(e, n, { duration: this.speed, complete: t });
    },
    clean() {
      this.list = this.list.filter((e) => e.state !== fr.DESTROYED);
    },
  },
});
function Vm(e, t, n, r, a, i) {
  return (
    J(),
    ut(
      "div",
      { class: "vue-notification-group", style: e.styles },
      [
        (J(),
        ut(
          Au(e.componentName),
          {
            name: e.animationName,
            onEnter: e.enter,
            onLeave: e.leave,
            onAfterLeave: e.clean,
          },
          {
            default: Gt(() => [
              (J(!0),
              ut(
                ye,
                null,
                Kt(
                  e.active,
                  (s) => (
                    J(),
                    ut(
                      "div",
                      {
                        key: s.id,
                        class: "vue-notification-wrapper",
                        style: e.notifyWrapperStyle(s),
                        "data-id": s.id,
                        onMouseenter:
                          t[1] ||
                          (t[1] = (...o) =>
                            e.pauseTimeout && e.pauseTimeout(...o)),
                        onMouseleave:
                          t[2] ||
                          (t[2] = (...o) =>
                            e.resumeTimeout && e.resumeTimeout(...o)),
                      },
                      [
                        Ci(
                          e.$slots,
                          "body",
                          {
                            class: [e.classes, s.type],
                            item: s,
                            close: () => e.destroy(s),
                          },
                          () => [
                            Tr(" Default slot template "),
                            ne(
                              "div",
                              {
                                class: e.notifyClass(s),
                                onClick: (o) => e.destroyIfNecessary(s),
                              },
                              [
                                s.title
                                  ? (J(),
                                    ut(
                                      "div",
                                      {
                                        key: 0,
                                        class: "notification-title",
                                        innerHTML: s.title,
                                      },
                                      null,
                                      8,
                                      ["innerHTML"]
                                    ))
                                  : Tr("v-if", !0),
                                ne(
                                  "div",
                                  {
                                    class: "notification-content",
                                    innerHTML: s.text,
                                  },
                                  null,
                                  8,
                                  ["innerHTML"]
                                ),
                              ],
                              10,
                              ["onClick"]
                            ),
                          ]
                        ),
                      ],
                      44,
                      ["data-id"]
                    )
                  )
                ),
                128
              )),
            ]),
            _: 3,
          },
          8,
          ["name", "onEnter", "onLeave", "onAfterLeave"]
        )),
      ],
      4
    )
  );
}
function Wm(e, t) {
  t === void 0 && (t = {});
  var n = t.insertAt;
  if (!(!e || typeof document == "undefined")) {
    var r = document.head || document.getElementsByTagName("head")[0],
      a = document.createElement("style");
    (a.type = "text/css"),
      n === "top" && r.firstChild
        ? r.insertBefore(a, r.firstChild)
        : r.appendChild(a),
      a.styleSheet
        ? (a.styleSheet.cssText = e)
        : a.appendChild(document.createTextNode(e));
  }
}
var qm = `
.vue-notification-group {\r
  display: block;\r
  position: fixed;\r
  z-index: 5000;
}
.vue-notification-wrapper {\r
  display: block;\r
  overflow: hidden;\r
  width: 100%;\r
  margin: 0;\r
  padding: 0;
}
.notification-title {\r
  font-weight: 600;
}
.vue-notification-template {\r
  display: block;\r
  box-sizing: border-box;\r
  background: white;\r
  text-align: left;
}
.vue-notification {\r
  display: block;\r
  box-sizing: border-box;\r
  text-align: left;\r
  font-size: 12px;\r
  padding: 10px;\r
  margin: 0 5px 5px;\r
\r
  color: white;\r
  background: #44A4FC;\r
  border-left: 5px solid #187FE7;
}
.vue-notification.warn {\r
  background: #ffb648;\r
  border-left-color: #f48a06;
}
.vue-notification.error {\r
  background: #E54D42;\r
  border-left-color: #B82E24;
}
.vue-notification.success {\r
  background: #68CD86;\r
  border-left-color: #42A85F;
}
.vn-fade-enter-active, .vn-fade-leave-active, .vn-fade-move  {\r
  transition: all .5s;
}
.vn-fade-enter-from, .vn-fade-leave-to {\r
  opacity: 0;
}\r
\r
`;
Wm(qm);
Wi.render = Vm;
Wi.__file = "src/Notifications.vue";
const Pc = (e) => {
  typeof e == "string" && (e = { title: "", text: e }),
    typeof e == "object" && Lr.emit("add", e);
};
Pc.close = function (e) {
  Lr.emit("close", e);
};
function Km(e, t = {}) {
  Object.entries(t).forEach((r) => Tc.set(...r));
  const n = t.name || "notify";
  (e.config.globalProperties["$" + n] = Pc),
    e.component(t.componentName || "notifications", Wi);
}
var Ym = { install: Km },
  Lt = (e, t) => {
    const n = e.__vccOpts || e;
    for (const [r, a] of t) n[r] = a;
    return n;
  };
const Gm = {},
  Xm = h(
    "b",
    null,
  );
function Jm(e, t) {
  const n = In("font"),
    r = In("marquee"),
    a = In("notifications"),
    i = In("RouterView");
  return (
    J(),
    pe(
      ye,
      null,
      [
        ne(
          r,
          {
            width: "100%",
            behavior: "scroll",
            style: {
              display: "block",
              position: "fixed",
              bottom: "70 px",
              left: "15 px",
              "z-index": "1000",
              cursor: "pointer",
              width: "100%",
            },
          },
          {
            default: Gt(() => [
              ne(
                n,
                {
                  color: "white",
                  style: {
                    "font-size": "15px",
                    "text-shadow":
                      "0 0 0.2em #ff0000, 0 0 0.2em #ff0000,  0 0 0.2em #ff0000",
                  },
                },
                { default: Gt(() => [Xm]), _: 1 }
              ),
            ]),
            _: 1,
          }
        ),
        ne(a, { position: "bottom right" }),
        ne(i),
      ],
      64
    )
  );
}
var Qm = Lt(Gm, [["render", Jm]]);
/*!
 * vue-router v4.1.1
 * (c) 2022 Eduardo San Martin Morote
 * @license MIT
 */ const ln = typeof window != "undefined";
function Zm(e) {
  return e.__esModule || e[Symbol.toStringTag] === "Module";
}
const oe = Object.assign;
function xa(e, t) {
  const n = {};
  for (const r in t) {
    const a = t[r];
    n[r] = Qe(a) ? a.map(e) : e(a);
  }
  return n;
}
const Vn = () => {},
  Qe = Array.isArray,
  ep = /\/$/,
  tp = (e) => e.replace(ep, "");
function wa(e, t, n = "/") {
  let r,
    a = {},
    i = "",
    s = "";
  const o = t.indexOf("#");
  let l = t.indexOf("?");
  return (
    o < l && o >= 0 && (l = -1),
    l > -1 &&
      ((r = t.slice(0, l)),
      (i = t.slice(l + 1, o > -1 ? o : t.length)),
      (a = e(i))),
    o > -1 && ((r = r || t.slice(0, o)), (s = t.slice(o, t.length))),
    (r = ip(r != null ? r : t, n)),
    { fullPath: r + (i && "?") + i + s, path: r, query: a, hash: s }
  );
}
function np(e, t) {
  const n = t.query ? e(t.query) : "";
  return t.path + (n && "?") + n + (t.hash || "");
}
function po(e, t) {
  return !t || !e.toLowerCase().startsWith(t.toLowerCase())
    ? e
    : e.slice(t.length) || "/";
}
function rp(e, t, n) {
  const r = t.matched.length - 1,
    a = n.matched.length - 1;
  return (
    r > -1 &&
    r === a &&
    vn(t.matched[r], n.matched[a]) &&
    $c(t.params, n.params) &&
    e(t.query) === e(n.query) &&
    t.hash === n.hash
  );
}
function vn(e, t) {
  return (e.aliasOf || e) === (t.aliasOf || t);
}
function $c(e, t) {
  if (Object.keys(e).length !== Object.keys(t).length) return !1;
  for (const n in e) if (!ap(e[n], t[n])) return !1;
  return !0;
}
function ap(e, t) {
  return Qe(e) ? go(e, t) : Qe(t) ? go(t, e) : e === t;
}
function go(e, t) {
  return Qe(t)
    ? e.length === t.length && e.every((n, r) => n === t[r])
    : e.length === 1 && e[0] === t;
}
function ip(e, t) {
  if (e.startsWith("/")) return e;
  if (!e) return t;
  const n = t.split("/"),
    r = e.split("/");
  let a = n.length - 1,
    i,
    s;
  for (i = 0; i < r.length; i++)
    if (((s = r[i]), s !== "."))
      if (s === "..") a > 1 && a--;
      else break;
  return (
    n.slice(0, a).join("/") +
    "/" +
    r.slice(i - (i === r.length ? 1 : 0)).join("/")
  );
}
var tr;
(function (e) {
  (e.pop = "pop"), (e.push = "push");
})(tr || (tr = {}));
var Wn;
(function (e) {
  (e.back = "back"), (e.forward = "forward"), (e.unknown = "");
})(Wn || (Wn = {}));
function sp(e) {
  if (!e)
    if (ln) {
      const t = document.querySelector("base");
      (e = (t && t.getAttribute("href")) || "/"),
        (e = e.replace(/^\w+:\/\/[^\/]+/, ""));
    } else e = "/";
  return e[0] !== "/" && e[0] !== "#" && (e = "/" + e), tp(e);
}
const op = /^[^#]+#/;
function lp(e, t) {
  return e.replace(op, "#") + t;
}
function cp(e, t) {
  const n = document.documentElement.getBoundingClientRect(),
    r = e.getBoundingClientRect();
  return {
    behavior: t.behavior,
    left: r.left - n.left - (t.left || 0),
    top: r.top - n.top - (t.top || 0),
  };
}
const aa = () => ({ left: window.pageXOffset, top: window.pageYOffset });
function fp(e) {
  let t;
  if ("el" in e) {
    const n = e.el,
      r = typeof n == "string" && n.startsWith("#"),
      a =
        typeof n == "string"
          ? r
            ? document.getElementById(n.slice(1))
            : document.querySelector(n)
          : n;
    if (!a) return;
    t = cp(a, e);
  } else t = e;
  "scrollBehavior" in document.documentElement.style
    ? window.scrollTo(t)
    : window.scrollTo(
        t.left != null ? t.left : window.pageXOffset,
        t.top != null ? t.top : window.pageYOffset
      );
}
function vo(e, t) {
  return (history.state ? history.state.position - t : -1) + e;
}
const ti = new Map();
function up(e, t) {
  ti.set(e, t);
}
function dp(e) {
  const t = ti.get(e);
  return ti.delete(e), t;
}
let hp = () => location.protocol + "//" + location.host;
function Rc(e, t) {
  const { pathname: n, search: r, hash: a } = t,
    i = e.indexOf("#");
  if (i > -1) {
    let o = a.includes(e.slice(i)) ? e.slice(i).length : 1,
      l = a.slice(o);
    return l[0] !== "/" && (l = "/" + l), po(l, "");
  }
  return po(n, e) + r + a;
}
function mp(e, t, n, r) {
  let a = [],
    i = [],
    s = null;
  const o = ({ state: m }) => {
    const g = Rc(e, location),
      E = n.value,
      T = t.value;
    let A = 0;
    if (m) {
      if (((n.value = g), (t.value = m), s && s === E)) {
        s = null;
        return;
      }
      A = T ? m.position - T.position : 0;
    } else r(g);
    a.forEach((v) => {
      v(n.value, E, {
        delta: A,
        type: tr.pop,
        direction: A ? (A > 0 ? Wn.forward : Wn.back) : Wn.unknown,
      });
    });
  };
  function l() {
    s = n.value;
  }
  function f(m) {
    a.push(m);
    const g = () => {
      const E = a.indexOf(m);
      E > -1 && a.splice(E, 1);
    };
    return i.push(g), g;
  }
  function c() {
    const { history: m } = window;
    !m.state || m.replaceState(oe({}, m.state, { scroll: aa() }), "");
  }
  function u() {
    for (const m of i) m();
    (i = []),
      window.removeEventListener("popstate", o),
      window.removeEventListener("beforeunload", c);
  }
  return (
    window.addEventListener("popstate", o),
    window.addEventListener("beforeunload", c),
    { pauseListeners: l, listen: f, destroy: u }
  );
}
function bo(e, t, n, r = !1, a = !1) {
  return {
    back: e,
    current: t,
    forward: n,
    replaced: r,
    position: window.history.length,
    scroll: a ? aa() : null,
  };
}
function pp(e) {
  const { history: t, location: n } = window,
    r = { value: Rc(e, n) },
    a = { value: t.state };
  a.value ||
    i(
      r.value,
      {
        back: null,
        current: r.value,
        forward: null,
        position: t.length - 1,
        replaced: !0,
        scroll: null,
      },
      !0
    );
  function i(l, f, c) {
    const u = e.indexOf("#"),
      m =
        u > -1
          ? (n.host && document.querySelector("base") ? e : e.slice(u)) + l
          : hp() + e + l;
    try {
      t[c ? "replaceState" : "pushState"](f, "", m), (a.value = f);
    } catch (g) {
      console.error(g), n[c ? "replace" : "assign"](m);
    }
  }
  function s(l, f) {
    const c = oe({}, t.state, bo(a.value.back, l, a.value.forward, !0), f, {
      position: a.value.position,
    });
    i(l, c, !0), (r.value = l);
  }
  function o(l, f) {
    const c = oe({}, a.value, t.state, { forward: l, scroll: aa() });
    i(c.current, c, !0);
    const u = oe({}, bo(r.value, l, null), { position: c.position + 1 }, f);
    i(l, u, !1), (r.value = l);
  }
  return { location: r, state: a, push: o, replace: s };
}
function gp(e) {
  e = sp(e);
  const t = pp(e),
    n = mp(e, t.state, t.location, t.replace);
  function r(i, s = !0) {
    s || n.pauseListeners(), history.go(i);
  }
  const a = oe(
    { location: "", base: e, go: r, createHref: lp.bind(null, e) },
    t,
    n
  );
  return (
    Object.defineProperty(a, "location", {
      enumerable: !0,
      get: () => t.location.value,
    }),
    Object.defineProperty(a, "state", {
      enumerable: !0,
      get: () => t.state.value,
    }),
    a
  );
}
function vp(e) {
  return typeof e == "string" || (e && typeof e == "object");
}
function Nc(e) {
  return typeof e == "string" || typeof e == "symbol";
}
const xt = {
    path: "/",
    name: void 0,
    params: {},
    query: {},
    hash: "",
    fullPath: "/",
    matched: [],
    meta: {},
    redirectedFrom: void 0,
  },
  Ic = Symbol("");
var yo;
(function (e) {
  (e[(e.aborted = 4)] = "aborted"),
    (e[(e.cancelled = 8)] = "cancelled"),
    (e[(e.duplicated = 16)] = "duplicated");
})(yo || (yo = {}));
function bn(e, t) {
  return oe(new Error(), { type: e, [Ic]: !0 }, t);
}
function wt(e, t) {
  return e instanceof Error && Ic in e && (t == null || !!(e.type & t));
}
const _o = "[^/]+?",
  bp = { sensitive: !1, strict: !1, start: !0, end: !0 },
  yp = /[.+*?^${}()[\]/\\]/g;
function _p(e, t) {
  const n = oe({}, bp, t),
    r = [];
  let a = n.start ? "^" : "";
  const i = [];
  for (const f of e) {
    const c = f.length ? [] : [90];
    n.strict && !f.length && (a += "/");
    for (let u = 0; u < f.length; u++) {
      const m = f[u];
      let g = 40 + (n.sensitive ? 0.25 : 0);
      if (m.type === 0)
        u || (a += "/"), (a += m.value.replace(yp, "\\$&")), (g += 40);
      else if (m.type === 1) {
        const { value: E, repeatable: T, optional: A, regexp: v } = m;
        i.push({ name: E, repeatable: T, optional: A });
        const y = v || _o;
        if (y !== _o) {
          g += 10;
          try {
            new RegExp(`(${y})`);
          } catch (D) {
            throw new Error(
              `Invalid custom RegExp for param "${E}" (${y}): ` + D.message
            );
          }
        }
        let $ = T ? `((?:${y})(?:/(?:${y}))*)` : `(${y})`;
        u || ($ = A && f.length < 2 ? `(?:/${$})` : "/" + $),
          A && ($ += "?"),
          (a += $),
          (g += 20),
          A && (g += -8),
          T && (g += -20),
          y === ".*" && (g += -50);
      }
      c.push(g);
    }
    r.push(c);
  }
  if (n.strict && n.end) {
    const f = r.length - 1;
    r[f][r[f].length - 1] += 0.7000000000000001;
  }
  n.strict || (a += "/?"), n.end ? (a += "$") : n.strict && (a += "(?:/|$)");
  const s = new RegExp(a, n.sensitive ? "" : "i");
  function o(f) {
    const c = f.match(s),
      u = {};
    if (!c) return null;
    for (let m = 1; m < c.length; m++) {
      const g = c[m] || "",
        E = i[m - 1];
      u[E.name] = g && E.repeatable ? g.split("/") : g;
    }
    return u;
  }
  function l(f) {
    let c = "",
      u = !1;
    for (const m of e) {
      (!u || !c.endsWith("/")) && (c += "/"), (u = !1);
      for (const g of m)
        if (g.type === 0) c += g.value;
        else if (g.type === 1) {
          const { value: E, repeatable: T, optional: A } = g,
            v = E in f ? f[E] : "";
          if (Qe(v) && !T)
            throw new Error(
              `Provided param "${E}" is an array but it is not repeatable (* or + modifiers)`
            );
          const y = Qe(v) ? v.join("/") : v;
          if (!y)
            if (A)
              m.length < 2 &&
                e.length > 1 &&
                (c.endsWith("/") ? (c = c.slice(0, -1)) : (u = !0));
            else throw new Error(`Missing required param "${E}"`);
          c += y;
        }
    }
    return c;
  }
  return { re: s, score: r, keys: i, parse: o, stringify: l };
}
function xp(e, t) {
  let n = 0;
  for (; n < e.length && n < t.length; ) {
    const r = t[n] - e[n];
    if (r) return r;
    n++;
  }
  return e.length < t.length
    ? e.length === 1 && e[0] === 40 + 40
      ? -1
      : 1
    : e.length > t.length
    ? t.length === 1 && t[0] === 40 + 40
      ? 1
      : -1
    : 0;
}
function wp(e, t) {
  let n = 0;
  const r = e.score,
    a = t.score;
  for (; n < r.length && n < a.length; ) {
    const i = xp(r[n], a[n]);
    if (i) return i;
    n++;
  }
  if (Math.abs(a.length - r.length) === 1) {
    if (xo(r)) return 1;
    if (xo(a)) return -1;
  }
  return a.length - r.length;
}
function xo(e) {
  const t = e[e.length - 1];
  return e.length > 0 && t[t.length - 1] < 0;
}
const Ep = { type: 0, value: "" },
  Cp = /[a-zA-Z0-9_]/;
function kp(e) {
  if (!e) return [[]];
  if (e === "/") return [[Ep]];
  if (!e.startsWith("/")) throw new Error(`Invalid path "${e}"`);
  function t(g) {
    throw new Error(`ERR (${n})/"${f}": ${g}`);
  }
  let n = 0,
    r = n;
  const a = [];
  let i;
  function s() {
    i && a.push(i), (i = []);
  }
  let o = 0,
    l,
    f = "",
    c = "";
  function u() {
    !f ||
      (n === 0
        ? i.push({ type: 0, value: f })
        : n === 1 || n === 2 || n === 3
        ? (i.length > 1 &&
            (l === "*" || l === "+") &&
            t(
              `A repeatable param (${f}) must be alone in its segment. eg: '/:ids+.`
            ),
          i.push({
            type: 1,
            value: f,
            regexp: c,
            repeatable: l === "*" || l === "+",
            optional: l === "*" || l === "?",
          }))
        : t("Invalid state to consume buffer"),
      (f = ""));
  }
  function m() {
    f += l;
  }
  for (; o < e.length; ) {
    if (((l = e[o++]), l === "\\" && n !== 2)) {
      (r = n), (n = 4);
      continue;
    }
    switch (n) {
      case 0:
        l === "/" ? (f && u(), s()) : l === ":" ? (u(), (n = 1)) : m();
        break;
      case 4:
        m(), (n = r);
        break;
      case 1:
        l === "("
          ? (n = 2)
          : Cp.test(l)
          ? m()
          : (u(), (n = 0), l !== "*" && l !== "?" && l !== "+" && o--);
        break;
      case 2:
        l === ")"
          ? c[c.length - 1] == "\\"
            ? (c = c.slice(0, -1) + l)
            : (n = 3)
          : (c += l);
        break;
      case 3:
        u(), (n = 0), l !== "*" && l !== "?" && l !== "+" && o--, (c = "");
        break;
      default:
        t("Unknown state");
        break;
    }
  }
  return n === 2 && t(`Unfinished custom RegExp for param "${f}"`), u(), s(), a;
}
function Ap(e, t, n) {
  const r = _p(kp(e.path), n),
    a = oe(r, { record: e, parent: t, children: [], alias: [] });
  return t && !a.record.aliasOf == !t.record.aliasOf && t.children.push(a), a;
}
function Op(e, t) {
  const n = [],
    r = new Map();
  t = Eo({ strict: !1, end: !0, sensitive: !1 }, t);
  function a(c) {
    return r.get(c);
  }
  function i(c, u, m) {
    const g = !m,
      E = Tp(c);
    E.aliasOf = m && m.record;
    const T = Eo(t, c),
      A = [E];
    if ("alias" in c) {
      const $ = typeof c.alias == "string" ? [c.alias] : c.alias;
      for (const D of $)
        A.push(
          oe({}, E, {
            components: m ? m.record.components : E.components,
            path: D,
            aliasOf: m ? m.record : E,
          })
        );
    }
    let v, y;
    for (const $ of A) {
      const { path: D } = $;
      if (u && D[0] !== "/") {
        const z = u.record.path,
          te = z[z.length - 1] === "/" ? "" : "/";
        $.path = u.record.path + (D && te + D);
      }
      if (
        ((v = Ap($, u, T)),
        m
          ? m.alias.push(v)
          : ((y = y || v),
            y !== v && y.alias.push(v),
            g && c.name && !wo(v) && s(c.name)),
        E.children)
      ) {
        const z = E.children;
        for (let te = 0; te < z.length; te++) i(z[te], v, m && m.children[te]);
      }
      (m = m || v), l(v);
    }
    return y
      ? () => {
          s(y);
        }
      : Vn;
  }
  function s(c) {
    if (Nc(c)) {
      const u = r.get(c);
      u &&
        (r.delete(c),
        n.splice(n.indexOf(u), 1),
        u.children.forEach(s),
        u.alias.forEach(s));
    } else {
      const u = n.indexOf(c);
      u > -1 &&
        (n.splice(u, 1),
        c.record.name && r.delete(c.record.name),
        c.children.forEach(s),
        c.alias.forEach(s));
    }
  }
  function o() {
    return n;
  }
  function l(c) {
    let u = 0;
    for (
      ;
      u < n.length &&
      wp(c, n[u]) >= 0 &&
      (c.record.path !== n[u].record.path || !Mc(c, n[u]));

    )
      u++;
    n.splice(u, 0, c), c.record.name && !wo(c) && r.set(c.record.name, c);
  }
  function f(c, u) {
    let m,
      g = {},
      E,
      T;
    if ("name" in c && c.name) {
      if (((m = r.get(c.name)), !m)) throw bn(1, { location: c });
      (T = m.record.name),
        (g = oe(
          Sp(
            u.params,
            m.keys.filter((y) => !y.optional).map((y) => y.name)
          ),
          c.params
        )),
        (E = m.stringify(g));
    } else if ("path" in c)
      (E = c.path),
        (m = n.find((y) => y.re.test(E))),
        m && ((g = m.parse(E)), (T = m.record.name));
    else {
      if (((m = u.name ? r.get(u.name) : n.find((y) => y.re.test(u.path))), !m))
        throw bn(1, { location: c, currentLocation: u });
      (T = m.record.name),
        (g = oe({}, u.params, c.params)),
        (E = m.stringify(g));
    }
    const A = [];
    let v = m;
    for (; v; ) A.unshift(v.record), (v = v.parent);
    return { name: T, path: E, params: g, matched: A, meta: $p(A) };
  }
  return (
    e.forEach((c) => i(c)),
    {
      addRoute: i,
      resolve: f,
      removeRoute: s,
      getRoutes: o,
      getRecordMatcher: a,
    }
  );
}
function Sp(e, t) {
  const n = {};
  for (const r of t) r in e && (n[r] = e[r]);
  return n;
}
function Tp(e) {
  return {
    path: e.path,
    redirect: e.redirect,
    name: e.name,
    meta: e.meta || {},
    aliasOf: void 0,
    beforeEnter: e.beforeEnter,
    props: Pp(e),
    children: e.children || [],
    instances: {},
    leaveGuards: new Set(),
    updateGuards: new Set(),
    enterCallbacks: {},
    components:
      "components" in e
        ? e.components || null
        : e.component && { default: e.component },
  };
}
function Pp(e) {
  const t = {},
    n = e.props || !1;
  if ("component" in e) t.default = n;
  else for (const r in e.components) t[r] = typeof n == "boolean" ? n : n[r];
  return t;
}
function wo(e) {
  for (; e; ) {
    if (e.record.aliasOf) return !0;
    e = e.parent;
  }
  return !1;
}
function $p(e) {
  return e.reduce((t, n) => oe(t, n.meta), {});
}
function Eo(e, t) {
  const n = {};
  for (const r in e) n[r] = r in t ? t[r] : e[r];
  return n;
}
function Mc(e, t) {
  return t.children.some((n) => n === e || Mc(e, n));
}
const Lc = /#/g,
  Rp = /&/g,
  Np = /\//g,
  Ip = /=/g,
  Mp = /\?/g,
  Dc = /\+/g,
  Lp = /%5B/g,
  Dp = /%5D/g,
  Fc = /%5E/g,
  Fp = /%60/g,
  jc = /%7B/g,
  jp = /%7C/g,
  Bc = /%7D/g,
  Bp = /%20/g;
function qi(e) {
  return encodeURI("" + e)
    .replace(jp, "|")
    .replace(Lp, "[")
    .replace(Dp, "]");
}
function Up(e) {
  return qi(e).replace(jc, "{").replace(Bc, "}").replace(Fc, "^");
}
function ni(e) {
  return qi(e)
    .replace(Dc, "%2B")
    .replace(Bp, "+")
    .replace(Lc, "%23")
    .replace(Rp, "%26")
    .replace(Fp, "`")
    .replace(jc, "{")
    .replace(Bc, "}")
    .replace(Fc, "^");
}
function zp(e) {
  return ni(e).replace(Ip, "%3D");
}
function Hp(e) {
  return qi(e).replace(Lc, "%23").replace(Mp, "%3F");
}
function Vp(e) {
  return e == null ? "" : Hp(e).replace(Np, "%2F");
}
function Dr(e) {
  try {
    return decodeURIComponent("" + e);
  } catch {}
  return "" + e;
}
function Wp(e) {
  const t = {};
  if (e === "" || e === "?") return t;
  const r = (e[0] === "?" ? e.slice(1) : e).split("&");
  for (let a = 0; a < r.length; ++a) {
    const i = r[a].replace(Dc, " "),
      s = i.indexOf("="),
      o = Dr(s < 0 ? i : i.slice(0, s)),
      l = s < 0 ? null : Dr(i.slice(s + 1));
    if (o in t) {
      let f = t[o];
      Qe(f) || (f = t[o] = [f]), f.push(l);
    } else t[o] = l;
  }
  return t;
}
function Co(e) {
  let t = "";
  for (let n in e) {
    const r = e[n];
    if (((n = zp(n)), r == null)) {
      r !== void 0 && (t += (t.length ? "&" : "") + n);
      continue;
    }
    (Qe(r) ? r.map((i) => i && ni(i)) : [r && ni(r)]).forEach((i) => {
      i !== void 0 &&
        ((t += (t.length ? "&" : "") + n), i != null && (t += "=" + i));
    });
  }
  return t;
}
function qp(e) {
  const t = {};
  for (const n in e) {
    const r = e[n];
    r !== void 0 &&
      (t[n] = Qe(r)
        ? r.map((a) => (a == null ? null : "" + a))
        : r == null
        ? r
        : "" + r);
  }
  return t;
}
const Kp = Symbol(""),
  ko = Symbol(""),
  Ki = Symbol(""),
  Uc = Symbol(""),
  ri = Symbol("");
function Pn() {
  let e = [];
  function t(r) {
    return (
      e.push(r),
      () => {
        const a = e.indexOf(r);
        a > -1 && e.splice(a, 1);
      }
    );
  }
  function n() {
    e = [];
  }
  return { add: t, list: () => e, reset: n };
}
function At(e, t, n, r, a) {
  const i = r && (r.enterCallbacks[a] = r.enterCallbacks[a] || []);
  return () =>
    new Promise((s, o) => {
      const l = (u) => {
          u === !1
            ? o(bn(4, { from: n, to: t }))
            : u instanceof Error
            ? o(u)
            : vp(u)
            ? o(bn(2, { from: t, to: u }))
            : (i &&
                r.enterCallbacks[a] === i &&
                typeof u == "function" &&
                i.push(u),
              s());
        },
        f = e.call(r && r.instances[a], t, n, l);
      let c = Promise.resolve(f);
      e.length < 3 && (c = c.then(l)), c.catch((u) => o(u));
    });
}
function Ea(e, t, n, r) {
  const a = [];
  for (const i of e)
    for (const s in i.components) {
      let o = i.components[s];
      if (!(t !== "beforeRouteEnter" && !i.instances[s]))
        if (Yp(o)) {
          const f = (o.__vccOpts || o)[t];
          f && a.push(At(f, n, r, i, s));
        } else {
          let l = o();
          a.push(() =>
            l.then((f) => {
              if (!f)
                return Promise.reject(
                  new Error(`Couldn't resolve component "${s}" at "${i.path}"`)
                );
              const c = Zm(f) ? f.default : f;
              i.components[s] = c;
              const m = (c.__vccOpts || c)[t];
              return m && At(m, n, r, i, s)();
            })
          );
        }
    }
  return a;
}
function Yp(e) {
  return (
    typeof e == "object" ||
    "displayName" in e ||
    "props" in e ||
    "__vccOpts" in e
  );
}
function Ao(e) {
  const t = Pt(Ki),
    n = Pt(Uc),
    r = ve(() => t.resolve(mn(e.to))),
    a = ve(() => {
      const { matched: l } = r.value,
        { length: f } = l,
        c = l[f - 1],
        u = n.matched;
      if (!c || !u.length) return -1;
      const m = u.findIndex(vn.bind(null, c));
      if (m > -1) return m;
      const g = Oo(l[f - 2]);
      return f > 1 && Oo(c) === g && u[u.length - 1].path !== g
        ? u.findIndex(vn.bind(null, l[f - 2]))
        : m;
    }),
    i = ve(() => a.value > -1 && Qp(n.params, r.value.params)),
    s = ve(
      () =>
        a.value > -1 &&
        a.value === n.matched.length - 1 &&
        $c(n.params, r.value.params)
    );
  function o(l = {}) {
    return Jp(l)
      ? t[mn(e.replace) ? "replace" : "push"](mn(e.to)).catch(Vn)
      : Promise.resolve();
  }
  return {
    route: r,
    href: ve(() => r.value.href),
    isActive: i,
    isExactActive: s,
    navigate: o,
  };
}
const Gp = Mt({
    name: "RouterLink",
    compatConfig: { MODE: 3 },
    props: {
      to: { type: [String, Object], required: !0 },
      replace: Boolean,
      activeClass: String,
      exactActiveClass: String,
      custom: Boolean,
      ariaCurrentValue: { type: String, default: "page" },
    },
    useLink: Ao,
    setup(e, { slots: t }) {
      const n = nr(Ao(e)),
        { options: r } = Pt(Ki),
        a = ve(() => ({
          [So(e.activeClass, r.linkActiveClass, "router-link-active")]:
            n.isActive,
          [So(
            e.exactActiveClass,
            r.linkExactActiveClass,
            "router-link-exact-active"
          )]: n.isExactActive,
        }));
      return () => {
        const i = t.default && t.default(n);
        return e.custom
          ? i
          : Qr(
              "a",
              {
                "aria-current": n.isExactActive ? e.ariaCurrentValue : null,
                href: n.href,
                onClick: n.navigate,
                class: a.value,
              },
              i
            );
      };
    },
  }),
  Xp = Gp;
function Jp(e) {
  if (
    !(e.metaKey || e.altKey || e.ctrlKey || e.shiftKey) &&
    !e.defaultPrevented &&
    !(e.button !== void 0 && e.button !== 0)
  ) {
    if (e.currentTarget && e.currentTarget.getAttribute) {
      const t = e.currentTarget.getAttribute("target");
      if (/\b_blank\b/i.test(t)) return;
    }
    return e.preventDefault && e.preventDefault(), !0;
  }
}
function Qp(e, t) {
  for (const n in t) {
    const r = t[n],
      a = e[n];
    if (typeof r == "string") {
      if (r !== a) return !1;
    } else if (!Qe(a) || a.length !== r.length || r.some((i, s) => i !== a[s]))
      return !1;
  }
  return !0;
}
function Oo(e) {
  return e ? (e.aliasOf ? e.aliasOf.path : e.path) : "";
}
const So = (e, t, n) => (e != null ? e : t != null ? t : n),
  Zp = Mt({
    name: "RouterView",
    inheritAttrs: !1,
    props: { name: { type: String, default: "default" }, route: Object },
    compatConfig: { MODE: 3 },
    setup(e, { attrs: t, slots: n }) {
      const r = Pt(ri),
        a = ve(() => e.route || r.value),
        i = Pt(ko, 0),
        s = ve(() => {
          let f = mn(i);
          const { matched: c } = a.value;
          let u;
          for (; (u = c[f]) && !u.components; ) f++;
          return f;
        }),
        o = ve(() => a.value.matched[s.value]);
      mr(
        ko,
        ve(() => s.value + 1)
      ),
        mr(Kp, o),
        mr(ri, a);
      const l = Kf();
      return (
        Fn(
          () => [l.value, o.value, e.name],
          ([f, c, u], [m, g, E]) => {
            c &&
              ((c.instances[u] = f),
              g &&
                g !== c &&
                f &&
                f === m &&
                (c.leaveGuards.size || (c.leaveGuards = g.leaveGuards),
                c.updateGuards.size || (c.updateGuards = g.updateGuards))),
              f &&
                c &&
                (!g || !vn(c, g) || !m) &&
                (c.enterCallbacks[u] || []).forEach((T) => T(f));
          },
          { flush: "post" }
        ),
        () => {
          const f = a.value,
            c = o.value,
            u = c && c.components[e.name],
            m = e.name;
          if (!u) return To(n.default, { Component: u, route: f });
          const g = c.props[e.name],
            E = g
              ? g === !0
                ? f.params
                : typeof g == "function"
                ? g(f)
                : g
              : null,
            A = Qr(
              u,
              oe({}, E, t, {
                onVnodeUnmounted: (v) => {
                  v.component.isUnmounted && (c.instances[m] = null);
                },
                ref: l,
              })
            );
          return To(n.default, { Component: A, route: f }) || A;
        }
      );
    },
  });
function To(e, t) {
  if (!e) return null;
  const n = e(t);
  return n.length === 1 ? n[0] : n;
}
const eg = Zp;
function tg(e) {
  const t = Op(e.routes, e),
    n = e.parseQuery || Wp,
    r = e.stringifyQuery || Co,
    a = e.history,
    i = Pn(),
    s = Pn(),
    o = Pn(),
    l = Yf(xt);
  let f = xt;
  ln &&
    e.scrollBehavior &&
    "scrollRestoration" in history &&
    (history.scrollRestoration = "manual");
  const c = xa.bind(null, (_) => "" + _),
    u = xa.bind(null, Vp),
    m = xa.bind(null, Dr);
  function g(_, L) {
    let P, F;
    return (
      Nc(_) ? ((P = t.getRecordMatcher(_)), (F = L)) : (F = _), t.addRoute(F, P)
    );
  }
  function E(_) {
    const L = t.getRecordMatcher(_);
    L && t.removeRoute(L);
  }
  function T() {
    return t.getRoutes().map((_) => _.record);
  }
  function A(_) {
    return !!t.getRecordMatcher(_);
  }
  function v(_, L) {
    if (((L = oe({}, L || l.value)), typeof _ == "string")) {
      const K = wa(n, _, L.path),
        d = t.resolve({ path: K.path }, L),
        p = a.createHref(K.fullPath);
      return oe(K, d, {
        params: m(d.params),
        hash: Dr(K.hash),
        redirectedFrom: void 0,
        href: p,
      });
    }
    let P;
    if ("path" in _) P = oe({}, _, { path: wa(n, _.path, L.path).path });
    else {
      const K = oe({}, _.params);
      for (const d in K) K[d] == null && delete K[d];
      (P = oe({}, _, { params: u(_.params) })), (L.params = u(L.params));
    }
    const F = t.resolve(P, L),
      ae = _.hash || "";
    F.params = c(m(F.params));
    const ue = np(r, oe({}, _, { hash: Up(ae), path: F.path })),
      Y = a.createHref(ue);
    return oe(
      { fullPath: ue, hash: ae, query: r === Co ? qp(_.query) : _.query || {} },
      F,
      { redirectedFrom: void 0, href: Y }
    );
  }
  function y(_) {
    return typeof _ == "string" ? wa(n, _, l.value.path) : oe({}, _);
  }
  function $(_, L) {
    if (f !== _) return bn(8, { from: L, to: _ });
  }
  function D(_) {
    return de(_);
  }
  function z(_) {
    return D(oe(y(_), { replace: !0 }));
  }
  function te(_) {
    const L = _.matched[_.matched.length - 1];
    if (L && L.redirect) {
      const { redirect: P } = L;
      let F = typeof P == "function" ? P(_) : P;
      return (
        typeof F == "string" &&
          ((F = F.includes("?") || F.includes("#") ? (F = y(F)) : { path: F }),
          (F.params = {})),
        oe(
          { query: _.query, hash: _.hash, params: "path" in F ? {} : _.params },
          F
        )
      );
    }
  }
  function de(_, L) {
    const P = (f = v(_)),
      F = l.value,
      ae = _.state,
      ue = _.force,
      Y = _.replace === !0,
      K = te(P);
    if (K) return de(oe(y(K), { state: ae, force: ue, replace: Y }), L || P);
    const d = P;
    d.redirectedFrom = L;
    let p;
    return (
      !ue &&
        rp(r, F, P) &&
        ((p = bn(16, { to: d, from: F })), Zt(F, F, !0, !1)),
      (p ? Promise.resolve(p) : G(d, F))
        .catch((b) => (wt(b) ? (wt(b, 2) ? b : Me(b)) : fe(b, d, F)))
        .then((b) => {
          if (b) {
            if (wt(b, 2))
              return de(
                oe(y(b.to), { state: ae, force: ue, replace: Y }),
                L || d
              );
          } else b = _e(d, F, !0, Y, ae);
          return ce(d, F, b), b;
        })
    );
  }
  function W(_, L) {
    const P = $(_, L);
    return P ? Promise.reject(P) : Promise.resolve();
  }
  function G(_, L) {
    let P;
    const [F, ae, ue] = ng(_, L);
    P = Ea(F.reverse(), "beforeRouteLeave", _, L);
    for (const K of F)
      K.leaveGuards.forEach((d) => {
        P.push(At(d, _, L));
      });
    const Y = W.bind(null, _, L);
    return (
      P.push(Y),
      tn(P)
        .then(() => {
          P = [];
          for (const K of i.list()) P.push(At(K, _, L));
          return P.push(Y), tn(P);
        })
        .then(() => {
          P = Ea(ae, "beforeRouteUpdate", _, L);
          for (const K of ae)
            K.updateGuards.forEach((d) => {
              P.push(At(d, _, L));
            });
          return P.push(Y), tn(P);
        })
        .then(() => {
          P = [];
          for (const K of _.matched)
            if (K.beforeEnter && !L.matched.includes(K))
              if (Qe(K.beforeEnter))
                for (const d of K.beforeEnter) P.push(At(d, _, L));
              else P.push(At(K.beforeEnter, _, L));
          return P.push(Y), tn(P);
        })
        .then(
          () => (
            _.matched.forEach((K) => (K.enterCallbacks = {})),
            (P = Ea(ue, "beforeRouteEnter", _, L)),
            P.push(Y),
            tn(P)
          )
        )
        .then(() => {
          P = [];
          for (const K of s.list()) P.push(At(K, _, L));
          return P.push(Y), tn(P);
        })
        .catch((K) => (wt(K, 8) ? K : Promise.reject(K)))
    );
  }
  function ce(_, L, P) {
    for (const F of o.list()) F(_, L, P);
  }
  function _e(_, L, P, F, ae) {
    const ue = $(_, L);
    if (ue) return ue;
    const Y = L === xt,
      K = ln ? history.state : {};
    P &&
      (F || Y
        ? a.replace(_.fullPath, oe({ scroll: Y && K && K.scroll }, ae))
        : a.push(_.fullPath, ae)),
      (l.value = _),
      Zt(_, L, P, Y),
      Me();
  }
  let I;
  function he() {
    I ||
      (I = a.listen((_, L, P) => {
        if (!On.listening) return;
        const F = v(_),
          ae = te(F);
        if (ae) {
          de(oe(ae, { replace: !0 }), F).catch(Vn);
          return;
        }
        f = F;
        const ue = l.value;
        ln && up(vo(ue.fullPath, P.delta), aa()),
          G(F, ue)
            .catch((Y) =>
              wt(Y, 12)
                ? Y
                : wt(Y, 2)
                ? (de(Y.to, F)
                    .then((K) => {
                      wt(K, 20) &&
                        !P.delta &&
                        P.type === tr.pop &&
                        a.go(-1, !1);
                    })
                    .catch(Vn),
                  Promise.reject())
                : (P.delta && a.go(-P.delta, !1), fe(Y, F, ue))
            )
            .then((Y) => {
              (Y = Y || _e(F, ue, !1)),
                Y &&
                  (P.delta
                    ? a.go(-P.delta, !1)
                    : P.type === tr.pop && wt(Y, 20) && a.go(-1, !1)),
                ce(F, ue, Y);
            })
            .catch(Vn);
      }));
  }
  let Oe = Pn(),
    st = Pn(),
    be;
  function fe(_, L, P) {
    Me(_);
    const F = st.list();
    return (
      F.length ? F.forEach((ae) => ae(_, L, P)) : console.error(_),
      Promise.reject(_)
    );
  }
  function re() {
    return be && l.value !== xt
      ? Promise.resolve()
      : new Promise((_, L) => {
          Oe.add([_, L]);
        });
  }
  function Me(_) {
    return (
      be ||
        ((be = !_),
        he(),
        Oe.list().forEach(([L, P]) => (_ ? P(_) : L())),
        Oe.reset()),
      _
    );
  }
  function Zt(_, L, P, F) {
    const { scrollBehavior: ae } = e;
    if (!ln || !ae) return Promise.resolve();
    const ue =
      (!P && dp(vo(_.fullPath, 0))) ||
      ((F || !P) && history.state && history.state.scroll) ||
      null;
    return dl()
      .then(() => ae(_, L, ue))
      .then((Y) => Y && fp(Y))
      .catch((Y) => fe(Y, _, L));
  }
  const ot = (_) => a.go(_);
  let Ze;
  const Ue = new Set(),
    On = {
      currentRoute: l,
      listening: !0,
      addRoute: g,
      removeRoute: E,
      hasRoute: A,
      getRoutes: T,
      resolve: v,
      options: e,
      push: D,
      replace: z,
      go: ot,
      back: () => ot(-1),
      forward: () => ot(1),
      beforeEach: i.add,
      beforeResolve: s.add,
      afterEach: o.add,
      onError: st.add,
      isReady: re,
      install(_) {
        const L = this;
        _.component("RouterLink", Xp),
          _.component("RouterView", eg),
          (_.config.globalProperties.$router = L),
          Object.defineProperty(_.config.globalProperties, "$route", {
            enumerable: !0,
            get: () => mn(l),
          }),
          ln &&
            !Ze &&
            l.value === xt &&
            ((Ze = !0), D(a.location).catch((ae) => {}));
        const P = {};
        for (const ae in xt) P[ae] = ve(() => l.value[ae]);
        _.provide(Ki, L), _.provide(Uc, nr(P)), _.provide(ri, l);
        const F = _.unmount;
        Ue.add(_),
          (_.unmount = function () {
            Ue.delete(_),
              Ue.size < 1 &&
                ((f = xt),
                I && I(),
                (I = null),
                (l.value = xt),
                (Ze = !1),
                (be = !1)),
              F();
          });
      },
    };
  return On;
}
function tn(e) {
  return e.reduce((t, n) => t.then(() => n()), Promise.resolve());
}
function ng(e, t) {
  const n = [],
    r = [],
    a = [],
    i = Math.max(t.matched.length, e.matched.length);
  for (let s = 0; s < i; s++) {
    const o = t.matched[s];
    o && (e.matched.find((f) => vn(f, o)) ? r.push(o) : n.push(o));
    const l = e.matched[s];
    l && (t.matched.find((f) => vn(f, l)) || a.push(l));
  }
  return [n, r, a];
}
const rg = { props: { logo: { type: String } } },
  ag = { class: "mainbar", style: { height: "120px" } },
  ig = { class: "navbar" },
  sg = { class: "container" },
  og = { href: "/", class: "text-center" },
  lg = ["src"];
function cg(e, t, n, r, a, i) {
  return (
    J(),
    pe("div", ag, [
      h("div", ig, [
        h("div", sg, [
          h("a", og, [
            h(
              "img",
              {
                src: n.logo,
                class: "animate__animated animate__infinite animate__pulse",
                height: "60",
                alt: "Logo",
              },
              null,
              8,
              lg
            ),
          ]),
        ]),
      ]),
    ])
  );
}
var fg = Lt(rg, [["render", cg]]);
const ug = {
    props: { data: { type: Array, required: !0 } },
    methods: {
      tabxxx(e, t) {
        this.$emit("tabChange", e);
        var n = document.getElementById("playing");
        n.scrollIntoView({ behavior: "smooth", block: "start" });
      },
    },
  },
  dg = { class: "text-center mt-5" },
  hg = ["onClick"];
function mg(e, t, n, r, a, i) {
  return (
    J(),
    pe("div", dg, [
      (J(!0),
      pe(
        ye,
        null,
        Kt(
          n.data,
          (s, o) => (
            J(),
            pe(
              "button",
              {
                key: o,
                class: "btn btn-default btn-primary mt-1",
                style: { "margin-right": "5px" },
                onClick: (l) => i.tabxxx(s.id, l),
              },
              Z(s.name),
              9,
              hg
            )
          )
        ),
        128
      )),
    ])
  );
}
var pg = Lt(ug, [["render", mg]]),
  Yi = { exports: {} },
  zc = function (t, n) {
    return function () {
      for (var a = new Array(arguments.length), i = 0; i < a.length; i++)
        a[i] = arguments[i];
      return t.apply(n, a);
    };
  },
  gg = zc,
  Gi = Object.prototype.toString,
  Xi = (function (e) {
    return function (t) {
      var n = Gi.call(t);
      return e[n] || (e[n] = n.slice(8, -1).toLowerCase());
    };
  })(Object.create(null));
function Qt(e) {
  return (
    (e = e.toLowerCase()),
    function (n) {
      return Xi(n) === e;
    }
  );
}
function Ji(e) {
  return Array.isArray(e);
}
function Fr(e) {
  return typeof e == "undefined";
}
function vg(e) {
  return (
    e !== null &&
    !Fr(e) &&
    e.constructor !== null &&
    !Fr(e.constructor) &&
    typeof e.constructor.isBuffer == "function" &&
    e.constructor.isBuffer(e)
  );
}
var Hc = Qt("ArrayBuffer");
function bg(e) {
  var t;
  return (
    typeof ArrayBuffer != "undefined" && ArrayBuffer.isView
      ? (t = ArrayBuffer.isView(e))
      : (t = e && e.buffer && Hc(e.buffer)),
    t
  );
}
function yg(e) {
  return typeof e == "string";
}
function _g(e) {
  return typeof e == "number";
}
function Vc(e) {
  return e !== null && typeof e == "object";
}
function _r(e) {
  if (Xi(e) !== "object") return !1;
  var t = Object.getPrototypeOf(e);
  return t === null || t === Object.prototype;
}
var xg = Qt("Date"),
  wg = Qt("File"),
  Eg = Qt("Blob"),
  Cg = Qt("FileList");
function Qi(e) {
  return Gi.call(e) === "[object Function]";
}
function kg(e) {
  return Vc(e) && Qi(e.pipe);
}
function Ag(e) {
  var t = "[object FormData]";
  return (
    e &&
    ((typeof FormData == "function" && e instanceof FormData) ||
      Gi.call(e) === t ||
      (Qi(e.toString) && e.toString() === t))
  );
}
var Og = Qt("URLSearchParams");
function Sg(e) {
  return e.trim ? e.trim() : e.replace(/^\s+|\s+$/g, "");
}
function Tg() {
  return typeof navigator != "undefined" &&
    (navigator.product === "ReactNative" ||
      navigator.product === "NativeScript" ||
      navigator.product === "NS")
    ? !1
    : typeof window != "undefined" && typeof document != "undefined";
}
function Zi(e, t) {
  if (!(e === null || typeof e == "undefined"))
    if ((typeof e != "object" && (e = [e]), Ji(e)))
      for (var n = 0, r = e.length; n < r; n++) t.call(null, e[n], n, e);
    else
      for (var a in e)
        Object.prototype.hasOwnProperty.call(e, a) && t.call(null, e[a], a, e);
}
function ai() {
  var e = {};
  function t(a, i) {
    _r(e[i]) && _r(a)
      ? (e[i] = ai(e[i], a))
      : _r(a)
      ? (e[i] = ai({}, a))
      : Ji(a)
      ? (e[i] = a.slice())
      : (e[i] = a);
  }
  for (var n = 0, r = arguments.length; n < r; n++) Zi(arguments[n], t);
  return e;
}
function Pg(e, t, n) {
  return (
    Zi(t, function (a, i) {
      n && typeof a == "function" ? (e[i] = gg(a, n)) : (e[i] = a);
    }),
    e
  );
}
function $g(e) {
  return e.charCodeAt(0) === 65279 && (e = e.slice(1)), e;
}
function Rg(e, t, n, r) {
  (e.prototype = Object.create(t.prototype, r)),
    (e.prototype.constructor = e),
    n && Object.assign(e.prototype, n);
}
function Ng(e, t, n) {
  var r,
    a,
    i,
    s = {};
  t = t || {};
  do {
    for (r = Object.getOwnPropertyNames(e), a = r.length; a-- > 0; )
      (i = r[a]), s[i] || ((t[i] = e[i]), (s[i] = !0));
    e = Object.getPrototypeOf(e);
  } while (e && (!n || n(e, t)) && e !== Object.prototype);
  return t;
}
function Ig(e, t, n) {
  (e = String(e)),
    (n === void 0 || n > e.length) && (n = e.length),
    (n -= t.length);
  var r = e.indexOf(t, n);
  return r !== -1 && r === n;
}
function Mg(e) {
  if (!e) return null;
  var t = e.length;
  if (Fr(t)) return null;
  for (var n = new Array(t); t-- > 0; ) n[t] = e[t];
  return n;
}
var Lg = (function (e) {
    return function (t) {
      return e && t instanceof e;
    };
  })(typeof Uint8Array != "undefined" && Object.getPrototypeOf(Uint8Array)),
  Ae = {
    isArray: Ji,
    isArrayBuffer: Hc,
    isBuffer: vg,
    isFormData: Ag,
    isArrayBufferView: bg,
    isString: yg,
    isNumber: _g,
    isObject: Vc,
    isPlainObject: _r,
    isUndefined: Fr,
    isDate: xg,
    isFile: wg,
    isBlob: Eg,
    isFunction: Qi,
    isStream: kg,
    isURLSearchParams: Og,
    isStandardBrowserEnv: Tg,
    forEach: Zi,
    merge: ai,
    extend: Pg,
    trim: Sg,
    stripBOM: $g,
    inherits: Rg,
    toFlatObject: Ng,
    kindOf: Xi,
    kindOfTest: Qt,
    endsWith: Ig,
    toArray: Mg,
    isTypedArray: Lg,
    isFileList: Cg,
  },
  nn = Ae;
function Po(e) {
  return encodeURIComponent(e)
    .replace(/%3A/gi, ":")
    .replace(/%24/g, "$")
    .replace(/%2C/gi, ",")
    .replace(/%20/g, "+")
    .replace(/%5B/gi, "[")
    .replace(/%5D/gi, "]");
}
var Wc = function (t, n, r) {
    if (!n) return t;
    var a;
    if (r) a = r(n);
    else if (nn.isURLSearchParams(n)) a = n.toString();
    else {
      var i = [];
      nn.forEach(n, function (l, f) {
        l === null ||
          typeof l == "undefined" ||
          (nn.isArray(l) ? (f = f + "[]") : (l = [l]),
          nn.forEach(l, function (u) {
            nn.isDate(u)
              ? (u = u.toISOString())
              : nn.isObject(u) && (u = JSON.stringify(u)),
              i.push(Po(f) + "=" + Po(u));
          }));
      }),
        (a = i.join("&"));
    }
    if (a) {
      var s = t.indexOf("#");
      s !== -1 && (t = t.slice(0, s)),
        (t += (t.indexOf("?") === -1 ? "?" : "&") + a);
    }
    return t;
  },
  Dg = Ae;
function ia() {
  this.handlers = [];
}
ia.prototype.use = function (t, n, r) {
  return (
    this.handlers.push({
      fulfilled: t,
      rejected: n,
      synchronous: r ? r.synchronous : !1,
      runWhen: r ? r.runWhen : null,
    }),
    this.handlers.length - 1
  );
};
ia.prototype.eject = function (t) {
  this.handlers[t] && (this.handlers[t] = null);
};
ia.prototype.forEach = function (t) {
  Dg.forEach(this.handlers, function (r) {
    r !== null && t(r);
  });
};
var Fg = ia,
  jg = Ae,
  Bg = function (t, n) {
    jg.forEach(t, function (a, i) {
      i !== n &&
        i.toUpperCase() === n.toUpperCase() &&
        ((t[n] = a), delete t[i]);
    });
  },
  qc = Ae;
function yn(e, t, n, r, a) {
  Error.call(this),
    (this.message = e),
    (this.name = "AxiosError"),
    t && (this.code = t),
    n && (this.config = n),
    r && (this.request = r),
    a && (this.response = a);
}
qc.inherits(yn, Error, {
  toJSON: function () {
    return {
      message: this.message,
      name: this.name,
      description: this.description,
      number: this.number,
      fileName: this.fileName,
      lineNumber: this.lineNumber,
      columnNumber: this.columnNumber,
      stack: this.stack,
      config: this.config,
      code: this.code,
      status:
        this.response && this.response.status ? this.response.status : null,
    };
  },
});
var Kc = yn.prototype,
  Yc = {};
[
  "ERR_BAD_OPTION_VALUE",
  "ERR_BAD_OPTION",
  "ECONNABORTED",
  "ETIMEDOUT",
  "ERR_NETWORK",
  "ERR_FR_TOO_MANY_REDIRECTS",
  "ERR_DEPRECATED",
  "ERR_BAD_RESPONSE",
  "ERR_BAD_REQUEST",
  "ERR_CANCELED",
].forEach(function (e) {
  Yc[e] = { value: e };
});
Object.defineProperties(yn, Yc);
Object.defineProperty(Kc, "isAxiosError", { value: !0 });
yn.from = function (e, t, n, r, a, i) {
  var s = Object.create(Kc);
  return (
    qc.toFlatObject(e, s, function (l) {
      return l !== Error.prototype;
    }),
    yn.call(s, e.message, t, n, r, a),
    (s.name = e.name),
    i && Object.assign(s, i),
    s
  );
};
var An = yn,
  Gc = {
    silentJSONParsing: !0,
    forcedJSONParsing: !0,
    clarifyTimeoutError: !1,
  },
  qe = Ae;
function Ug(e, t) {
  t = t || new FormData();
  var n = [];
  function r(i) {
    return i === null
      ? ""
      : qe.isDate(i)
      ? i.toISOString()
      : qe.isArrayBuffer(i) || qe.isTypedArray(i)
      ? typeof Blob == "function"
        ? new Blob([i])
        : Buffer.from(i)
      : i;
  }
  function a(i, s) {
    if (qe.isPlainObject(i) || qe.isArray(i)) {
      if (n.indexOf(i) !== -1)
        throw Error("Circular reference detected in " + s);
      n.push(i),
        qe.forEach(i, function (l, f) {
          if (!qe.isUndefined(l)) {
            var c = s ? s + "." + f : f,
              u;
            if (l && !s && typeof l == "object") {
              if (qe.endsWith(f, "{}")) l = JSON.stringify(l);
              else if (qe.endsWith(f, "[]") && (u = qe.toArray(l))) {
                u.forEach(function (m) {
                  !qe.isUndefined(m) && t.append(c, r(m));
                });
                return;
              }
            }
            a(l, c);
          }
        }),
        n.pop();
    } else t.append(s, r(i));
  }
  return a(e), t;
}
var Xc = Ug,
  Ca = An,
  zg = function (t, n, r) {
    var a = r.config.validateStatus;
    !r.status || !a || a(r.status)
      ? t(r)
      : n(
          new Ca(
            "Request failed with status code " + r.status,
            [Ca.ERR_BAD_REQUEST, Ca.ERR_BAD_RESPONSE][
              Math.floor(r.status / 100) - 4
            ],
            r.config,
            r.request,
            r
          )
        );
  },
  ur = Ae,
  Hg = ur.isStandardBrowserEnv()
    ? (function () {
        return {
          write: function (n, r, a, i, s, o) {
            var l = [];
            l.push(n + "=" + encodeURIComponent(r)),
              ur.isNumber(a) && l.push("expires=" + new Date(a).toGMTString()),
              ur.isString(i) && l.push("path=" + i),
              ur.isString(s) && l.push("domain=" + s),
              o === !0 && l.push("secure"),
              (document.cookie = l.join("; "));
          },
          read: function (n) {
            var r = document.cookie.match(
              new RegExp("(^|;\\s*)(" + n + ")=([^;]*)")
            );
            return r ? decodeURIComponent(r[3]) : null;
          },
          remove: function (n) {
            this.write(n, "", Date.now() - 864e5);
          },
        };
      })()
    : (function () {
        return {
          write: function () {},
          read: function () {
            return null;
          },
          remove: function () {},
        };
      })(),
  Vg = function (t) {
    return /^([a-z][a-z\d+\-.]*:)?\/\//i.test(t);
  },
  Wg = function (t, n) {
    return n ? t.replace(/\/+$/, "") + "/" + n.replace(/^\/+/, "") : t;
  },
  qg = Vg,
  Kg = Wg,
  Jc = function (t, n) {
    return t && !qg(n) ? Kg(t, n) : n;
  },
  ka = Ae,
  Yg = [
    "age",
    "authorization",
    "content-length",
    "content-type",
    "etag",
    "expires",
    "from",
    "host",
    "if-modified-since",
    "if-unmodified-since",
    "last-modified",
    "location",
    "max-forwards",
    "proxy-authorization",
    "referer",
    "retry-after",
    "user-agent",
  ],
  Gg = function (t) {
    var n = {},
      r,
      a,
      i;
    return (
      t &&
        ka.forEach(
          t.split(`
`),
          function (o) {
            if (
              ((i = o.indexOf(":")),
              (r = ka.trim(o.substr(0, i)).toLowerCase()),
              (a = ka.trim(o.substr(i + 1))),
              r)
            ) {
              if (n[r] && Yg.indexOf(r) >= 0) return;
              r === "set-cookie"
                ? (n[r] = (n[r] ? n[r] : []).concat([a]))
                : (n[r] = n[r] ? n[r] + ", " + a : a);
            }
          }
        ),
      n
    );
  },
  $o = Ae,
  Xg = $o.isStandardBrowserEnv()
    ? (function () {
        var t = /(msie|trident)/i.test(navigator.userAgent),
          n = document.createElement("a"),
          r;
        function a(i) {
          var s = i;
          return (
            t && (n.setAttribute("href", s), (s = n.href)),
            n.setAttribute("href", s),
            {
              href: n.href,
              protocol: n.protocol ? n.protocol.replace(/:$/, "") : "",
              host: n.host,
              search: n.search ? n.search.replace(/^\?/, "") : "",
              hash: n.hash ? n.hash.replace(/^#/, "") : "",
              hostname: n.hostname,
              port: n.port,
              pathname:
                n.pathname.charAt(0) === "/" ? n.pathname : "/" + n.pathname,
            }
          );
        }
        return (
          (r = a(window.location.href)),
          function (s) {
            var o = $o.isString(s) ? a(s) : s;
            return o.protocol === r.protocol && o.host === r.host;
          }
        );
      })()
    : (function () {
        return function () {
          return !0;
        };
      })(),
  ii = An,
  Jg = Ae;
function Qc(e) {
  ii.call(this, e == null ? "canceled" : e, ii.ERR_CANCELED),
    (this.name = "CanceledError");
}
Jg.inherits(Qc, ii, { __CANCEL__: !0 });
var sa = Qc,
  Qg = function (t) {
    var n = /^([-+\w]{1,25})(:?\/\/|:)/.exec(t);
    return (n && n[1]) || "";
  },
  $n = Ae,
  Zg = zg,
  ev = Hg,
  tv = Wc,
  nv = Jc,
  rv = Gg,
  av = Xg,
  iv = Gc,
  lt = An,
  sv = sa,
  ov = Qg,
  Ro = function (t) {
    return new Promise(function (r, a) {
      var i = t.data,
        s = t.headers,
        o = t.responseType,
        l;
      function f() {
        t.cancelToken && t.cancelToken.unsubscribe(l),
          t.signal && t.signal.removeEventListener("abort", l);
      }
      $n.isFormData(i) && $n.isStandardBrowserEnv() && delete s["Content-Type"];
      var c = new XMLHttpRequest();
      if (t.auth) {
        var u = t.auth.username || "",
          m = t.auth.password
            ? unescape(encodeURIComponent(t.auth.password))
            : "";
        s.Authorization = "Basic " + btoa(u + ":" + m);
      }
      var g = nv(t.baseURL, t.url);
      c.open(t.method.toUpperCase(), tv(g, t.params, t.paramsSerializer), !0),
        (c.timeout = t.timeout);
      function E() {
        if (!!c) {
          var v =
              "getAllResponseHeaders" in c
                ? rv(c.getAllResponseHeaders())
                : null,
            y =
              !o || o === "text" || o === "json" ? c.responseText : c.response,
            $ = {
              data: y,
              status: c.status,
              statusText: c.statusText,
              headers: v,
              config: t,
              request: c,
            };
          Zg(
            function (z) {
              r(z), f();
            },
            function (z) {
              a(z), f();
            },
            $
          ),
            (c = null);
        }
      }
      if (
        ("onloadend" in c
          ? (c.onloadend = E)
          : (c.onreadystatechange = function () {
              !c ||
                c.readyState !== 4 ||
                (c.status === 0 &&
                  !(c.responseURL && c.responseURL.indexOf("file:") === 0)) ||
                setTimeout(E);
            }),
        (c.onabort = function () {
          !c ||
            (a(new lt("Request aborted", lt.ECONNABORTED, t, c)), (c = null));
        }),
        (c.onerror = function () {
          a(new lt("Network Error", lt.ERR_NETWORK, t, c, c)), (c = null);
        }),
        (c.ontimeout = function () {
          var y = t.timeout
              ? "timeout of " + t.timeout + "ms exceeded"
              : "timeout exceeded",
            $ = t.transitional || iv;
          t.timeoutErrorMessage && (y = t.timeoutErrorMessage),
            a(
              new lt(
                y,
                $.clarifyTimeoutError ? lt.ETIMEDOUT : lt.ECONNABORTED,
                t,
                c
              )
            ),
            (c = null);
        }),
        $n.isStandardBrowserEnv())
      ) {
        var T =
          (t.withCredentials || av(g)) && t.xsrfCookieName
            ? ev.read(t.xsrfCookieName)
            : void 0;
        T && (s[t.xsrfHeaderName] = T);
      }
      "setRequestHeader" in c &&
        $n.forEach(s, function (y, $) {
          typeof i == "undefined" && $.toLowerCase() === "content-type"
            ? delete s[$]
            : c.setRequestHeader($, y);
        }),
        $n.isUndefined(t.withCredentials) ||
          (c.withCredentials = !!t.withCredentials),
        o && o !== "json" && (c.responseType = t.responseType),
        typeof t.onDownloadProgress == "function" &&
          c.addEventListener("progress", t.onDownloadProgress),
        typeof t.onUploadProgress == "function" &&
          c.upload &&
          c.upload.addEventListener("progress", t.onUploadProgress),
        (t.cancelToken || t.signal) &&
          ((l = function (v) {
            !c ||
              (a(!v || (v && v.type) ? new sv() : v), c.abort(), (c = null));
          }),
          t.cancelToken && t.cancelToken.subscribe(l),
          t.signal &&
            (t.signal.aborted ? l() : t.signal.addEventListener("abort", l))),
        i || (i = null);
      var A = ov(g);
      if (A && ["http", "https", "file"].indexOf(A) === -1) {
        a(new lt("Unsupported protocol " + A + ":", lt.ERR_BAD_REQUEST, t));
        return;
      }
      c.send(i);
    });
  },
  lv = null,
  Ee = Ae,
  No = Bg,
  Io = An,
  cv = Gc,
  fv = Xc,
  uv = { "Content-Type": "application/x-www-form-urlencoded" };
function Mo(e, t) {
  !Ee.isUndefined(e) &&
    Ee.isUndefined(e["Content-Type"]) &&
    (e["Content-Type"] = t);
}
function dv() {
  var e;
  return (
    (typeof XMLHttpRequest != "undefined" ||
      (typeof process != "undefined" &&
        Object.prototype.toString.call(process) === "[object process]")) &&
      (e = Ro),
    e
  );
}
function hv(e, t, n) {
  if (Ee.isString(e))
    try {
      return (t || JSON.parse)(e), Ee.trim(e);
    } catch (r) {
      if (r.name !== "SyntaxError") throw r;
    }
  return (n || JSON.stringify)(e);
}
var oa = {
  transitional: cv,
  adapter: dv(),
  transformRequest: [
    function (t, n) {
      if (
        (No(n, "Accept"),
        No(n, "Content-Type"),
        Ee.isFormData(t) ||
          Ee.isArrayBuffer(t) ||
          Ee.isBuffer(t) ||
          Ee.isStream(t) ||
          Ee.isFile(t) ||
          Ee.isBlob(t))
      )
        return t;
      if (Ee.isArrayBufferView(t)) return t.buffer;
      if (Ee.isURLSearchParams(t))
        return (
          Mo(n, "application/x-www-form-urlencoded;charset=utf-8"), t.toString()
        );
      var r = Ee.isObject(t),
        a = n && n["Content-Type"],
        i;
      if ((i = Ee.isFileList(t)) || (r && a === "multipart/form-data")) {
        var s = this.env && this.env.FormData;
        return fv(i ? { "files[]": t } : t, s && new s());
      } else if (r || a === "application/json")
        return Mo(n, "application/json"), hv(t);
      return t;
    },
  ],
  transformResponse: [
    function (t) {
      var n = this.transitional || oa.transitional,
        r = n && n.silentJSONParsing,
        a = n && n.forcedJSONParsing,
        i = !r && this.responseType === "json";
      if (i || (a && Ee.isString(t) && t.length))
        try {
          return JSON.parse(t);
        } catch (s) {
          if (i)
            throw s.name === "SyntaxError"
              ? Io.from(s, Io.ERR_BAD_RESPONSE, this, null, this.response)
              : s;
        }
      return t;
    },
  ],
  timeout: 0,
  xsrfCookieName: "XSRF-TOKEN",
  xsrfHeaderName: "X-XSRF-TOKEN",
  maxContentLength: -1,
  maxBodyLength: -1,
  env: { FormData: lv },
  validateStatus: function (t) {
    return t >= 200 && t < 300;
  },
  headers: { common: { Accept: "application/json, text/plain, */*" } },
};
Ee.forEach(["delete", "get", "head"], function (t) {
  oa.headers[t] = {};
});
Ee.forEach(["post", "put", "patch"], function (t) {
  oa.headers[t] = Ee.merge(uv);
});
var es = oa,
  mv = Ae,
  pv = es,
  gv = function (t, n, r) {
    var a = this || pv;
    return (
      mv.forEach(r, function (s) {
        t = s.call(a, t, n);
      }),
      t
    );
  },
  Zc = function (t) {
    return !!(t && t.__CANCEL__);
  },
  Lo = Ae,
  Aa = gv,
  vv = Zc,
  bv = es,
  yv = sa;
function Oa(e) {
  if (
    (e.cancelToken && e.cancelToken.throwIfRequested(),
    e.signal && e.signal.aborted)
  )
    throw new yv();
}
var _v = function (t) {
    Oa(t),
      (t.headers = t.headers || {}),
      (t.data = Aa.call(t, t.data, t.headers, t.transformRequest)),
      (t.headers = Lo.merge(
        t.headers.common || {},
        t.headers[t.method] || {},
        t.headers
      )),
      Lo.forEach(
        ["delete", "get", "head", "post", "put", "patch", "common"],
        function (a) {
          delete t.headers[a];
        }
      );
    var n = t.adapter || bv.adapter;
    return n(t).then(
      function (a) {
        return (
          Oa(t),
          (a.data = Aa.call(t, a.data, a.headers, t.transformResponse)),
          a
        );
      },
      function (a) {
        return (
          vv(a) ||
            (Oa(t),
            a &&
              a.response &&
              (a.response.data = Aa.call(
                t,
                a.response.data,
                a.response.headers,
                t.transformResponse
              ))),
          Promise.reject(a)
        );
      }
    );
  },
  De = Ae,
  ef = function (t, n) {
    n = n || {};
    var r = {};
    function a(c, u) {
      return De.isPlainObject(c) && De.isPlainObject(u)
        ? De.merge(c, u)
        : De.isPlainObject(u)
        ? De.merge({}, u)
        : De.isArray(u)
        ? u.slice()
        : u;
    }
    function i(c) {
      if (De.isUndefined(n[c])) {
        if (!De.isUndefined(t[c])) return a(void 0, t[c]);
      } else return a(t[c], n[c]);
    }
    function s(c) {
      if (!De.isUndefined(n[c])) return a(void 0, n[c]);
    }
    function o(c) {
      if (De.isUndefined(n[c])) {
        if (!De.isUndefined(t[c])) return a(void 0, t[c]);
      } else return a(void 0, n[c]);
    }
    function l(c) {
      if (c in n) return a(t[c], n[c]);
      if (c in t) return a(void 0, t[c]);
    }
    var f = {
      url: s,
      method: s,
      data: s,
      baseURL: o,
      transformRequest: o,
      transformResponse: o,
      paramsSerializer: o,
      timeout: o,
      timeoutMessage: o,
      withCredentials: o,
      adapter: o,
      responseType: o,
      xsrfCookieName: o,
      xsrfHeaderName: o,
      onUploadProgress: o,
      onDownloadProgress: o,
      decompress: o,
      maxContentLength: o,
      maxBodyLength: o,
      beforeRedirect: o,
      transport: o,
      httpAgent: o,
      httpsAgent: o,
      cancelToken: o,
      socketPath: o,
      responseEncoding: o,
      validateStatus: l,
    };
    return (
      De.forEach(Object.keys(t).concat(Object.keys(n)), function (u) {
        var m = f[u] || i,
          g = m(u);
        (De.isUndefined(g) && m !== l) || (r[u] = g);
      }),
      r
    );
  },
  tf = { version: "0.27.2" },
  xv = tf.version,
  Ot = An,
  ts = {};
["object", "boolean", "number", "function", "string", "symbol"].forEach(
  function (e, t) {
    ts[e] = function (r) {
      return typeof r === e || "a" + (t < 1 ? "n " : " ") + e;
    };
  }
);
var Do = {};
ts.transitional = function (t, n, r) {
  function a(i, s) {
    return (
      "[Axios v" +
      xv +
      "] Transitional option '" +
      i +
      "'" +
      s +
      (r ? ". " + r : "")
    );
  }
  return function (i, s, o) {
    if (t === !1)
      throw new Ot(
        a(s, " has been removed" + (n ? " in " + n : "")),
        Ot.ERR_DEPRECATED
      );
    return (
      n &&
        !Do[s] &&
        ((Do[s] = !0),
        console.warn(
          a(
            s,
            " has been deprecated since v" +
              n +
              " and will be removed in the near future"
          )
        )),
      t ? t(i, s, o) : !0
    );
  };
};
function wv(e, t, n) {
  if (typeof e != "object")
    throw new Ot("options must be an object", Ot.ERR_BAD_OPTION_VALUE);
  for (var r = Object.keys(e), a = r.length; a-- > 0; ) {
    var i = r[a],
      s = t[i];
    if (s) {
      var o = e[i],
        l = o === void 0 || s(o, i, e);
      if (l !== !0)
        throw new Ot("option " + i + " must be " + l, Ot.ERR_BAD_OPTION_VALUE);
      continue;
    }
    if (n !== !0) throw new Ot("Unknown option " + i, Ot.ERR_BAD_OPTION);
  }
}
var Ev = { assertOptions: wv, validators: ts },
  nf = Ae,
  Cv = Wc,
  Fo = Fg,
  jo = _v,
  la = ef,
  kv = Jc,
  rf = Ev,
  rn = rf.validators;
function _n(e) {
  (this.defaults = e),
    (this.interceptors = { request: new Fo(), response: new Fo() });
}
_n.prototype.request = function (t, n) {
  typeof t == "string" ? ((n = n || {}), (n.url = t)) : (n = t || {}),
    (n = la(this.defaults, n)),
    n.method
      ? (n.method = n.method.toLowerCase())
      : this.defaults.method
      ? (n.method = this.defaults.method.toLowerCase())
      : (n.method = "get");
  var r = n.transitional;
  r !== void 0 &&
    rf.assertOptions(
      r,
      {
        silentJSONParsing: rn.transitional(rn.boolean),
        forcedJSONParsing: rn.transitional(rn.boolean),
        clarifyTimeoutError: rn.transitional(rn.boolean),
      },
      !1
    );
  var a = [],
    i = !0;
  this.interceptors.request.forEach(function (g) {
    (typeof g.runWhen == "function" && g.runWhen(n) === !1) ||
      ((i = i && g.synchronous), a.unshift(g.fulfilled, g.rejected));
  });
  var s = [];
  this.interceptors.response.forEach(function (g) {
    s.push(g.fulfilled, g.rejected);
  });
  var o;
  if (!i) {
    var l = [jo, void 0];
    for (
      Array.prototype.unshift.apply(l, a),
        l = l.concat(s),
        o = Promise.resolve(n);
      l.length;

    )
      o = o.then(l.shift(), l.shift());
    return o;
  }
  for (var f = n; a.length; ) {
    var c = a.shift(),
      u = a.shift();
    try {
      f = c(f);
    } catch (m) {
      u(m);
      break;
    }
  }
  try {
    o = jo(f);
  } catch (m) {
    return Promise.reject(m);
  }
  for (; s.length; ) o = o.then(s.shift(), s.shift());
  return o;
};
_n.prototype.getUri = function (t) {
  t = la(this.defaults, t);
  var n = kv(t.baseURL, t.url);
  return Cv(n, t.params, t.paramsSerializer);
};
nf.forEach(["delete", "get", "head", "options"], function (t) {
  _n.prototype[t] = function (n, r) {
    return this.request(
      la(r || {}, { method: t, url: n, data: (r || {}).data })
    );
  };
});
nf.forEach(["post", "put", "patch"], function (t) {
  function n(r) {
    return function (i, s, o) {
      return this.request(
        la(o || {}, {
          method: t,
          headers: r ? { "Content-Type": "multipart/form-data" } : {},
          url: i,
          data: s,
        })
      );
    };
  }
  (_n.prototype[t] = n()), (_n.prototype[t + "Form"] = n(!0));
});
var Av = _n,
  Ov = sa;
function xn(e) {
  if (typeof e != "function")
    throw new TypeError("executor must be a function.");
  var t;
  this.promise = new Promise(function (a) {
    t = a;
  });
  var n = this;
  this.promise.then(function (r) {
    if (!!n._listeners) {
      var a,
        i = n._listeners.length;
      for (a = 0; a < i; a++) n._listeners[a](r);
      n._listeners = null;
    }
  }),
    (this.promise.then = function (r) {
      var a,
        i = new Promise(function (s) {
          n.subscribe(s), (a = s);
        }).then(r);
      return (
        (i.cancel = function () {
          n.unsubscribe(a);
        }),
        i
      );
    }),
    e(function (a) {
      n.reason || ((n.reason = new Ov(a)), t(n.reason));
    });
}
xn.prototype.throwIfRequested = function () {
  if (this.reason) throw this.reason;
};
xn.prototype.subscribe = function (t) {
  if (this.reason) {
    t(this.reason);
    return;
  }
  this._listeners ? this._listeners.push(t) : (this._listeners = [t]);
};
xn.prototype.unsubscribe = function (t) {
  if (!!this._listeners) {
    var n = this._listeners.indexOf(t);
    n !== -1 && this._listeners.splice(n, 1);
  }
};
xn.source = function () {
  var t,
    n = new xn(function (a) {
      t = a;
    });
  return { token: n, cancel: t };
};
var Sv = xn,
  Tv = function (t) {
    return function (r) {
      return t.apply(null, r);
    };
  },
  Pv = Ae,
  $v = function (t) {
    return Pv.isObject(t) && t.isAxiosError === !0;
  },
  Bo = Ae,
  Rv = zc,
  xr = Av,
  Nv = ef,
  Iv = es;
function af(e) {
  var t = new xr(e),
    n = Rv(xr.prototype.request, t);
  return (
    Bo.extend(n, xr.prototype, t),
    Bo.extend(n, t),
    (n.create = function (a) {
      return af(Nv(e, a));
    }),
    n
  );
}
var Ie = af(Iv);
Ie.Axios = xr;
Ie.CanceledError = sa;
Ie.CancelToken = Sv;
Ie.isCancel = Zc;
Ie.VERSION = tf.version;
Ie.toFormData = Xc;
Ie.AxiosError = An;
Ie.Cancel = Ie.CanceledError;
Ie.all = function (t) {
  return Promise.all(t);
};
Ie.spread = Tv;
Ie.isAxiosError = $v;
Yi.exports = Ie;
Yi.exports.default = Ie;
var si = Yi.exports;
const Mv = {
    props: {
      data: { type: Array, default: [] },
      website: { type: Object, default: {} },
    },
    data() {
      return { code: "", loading: !1, message: "" };
    },
    methods: {
      async copyPhone(e) {
        await navigator.clipboard.writeText(e),
          this.$notify({
            title: "Copy th\xE0nh c\xF4ng",
            text: "Ch\xFAc b\u1EA1n ch\u01A1i game vui v\u1EBB!",
            type: "success",
          });
      },
      formatVND(e) {
        return e.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
      },
      nFormatter(e, t) {
        const n = [
            { value: 1, symbol: "" },
            { value: 1e3, symbol: "K" },
            { value: 1e6, symbol: "M" },
            { value: 1e9, symbol: "G" },
            { value: 1e12, symbol: "T" },
            { value: 1e15, symbol: "P" },
            { value: 1e18, symbol: "E" },
          ],
          r = /\.0+$|(\.[0-9]*[1-9])0+$/;
        var a = n
          .slice()
          .reverse()
          .find(function (i) {
            return e >= i.value;
          });
        return a ? (e / a.value).toFixed(t).replace(r, "$1") + a.symbol : "0";
      },
      async checkMGD() {
        this.loading = !0;
        try {
          const e = await si.get(`/api/check.php?code=${this.code}`);
          (this.loading = !1),
            e.data.message
              ? (this.message = e.data.message)
              : (this.message = "C\xF3 l\u1ED7i x\u1EA3y ra!");
        } catch {
          (this.loading = !1), (this.message = "C\xF3 l\u1ED7i x\u1EA3y ra!");
        }
      },
    },
  },
  Dt = (e) => (iu("data-v-143cd333"), (e = e()), su(), e),
  Lv = {
    class: "col-md-6 mt-3 cl animate__animated animate__fadeInUp animate__slow",
  },
  Dv = { class: "panel panel-primary" },
  Fv = Dt(() =>
    h(
      "div",
      { class: "panel-heading text-center" },
      " KI\u1EC2M TRA M\xC3 GIAO D\u1ECACH ",
      -1
    )
  ),
  jv = { class: "panel-body text-center" },
  Bv = Dt(() =>
    h(
      "div",
      { class: "alert alert-info text-left" },
      " N\u1EBFu qu\xE1 10 ph\xFAt ch\u01B0a nh\u1EADn \u0111\u01B0\u1EE3c ti\u1EC1n vui l\xF2ng d\xE1n m\xE3 v\xE0o \u0111\xE2y \u0111\u1EC3 ki\u1EC3m tra. ",
      -1
    )
  ),
  Uv = { class: "text-center" },
  zv = { class: "form-group" },
  Hv = Dt(() =>
    h("label", { for: "tran_id" }, "Nh\u1EADp m\xE3 giao d\u1ECBch", -1)
  ),
  Vv = Dt(() =>
    h(
      "small",
      { id: "checkHelp", class: "form-text text-muted" },
      "Nh\u1EADp m\xE3 giao d\u1ECBch c\u1EE7a b\u1EA1n \u0111\u1EC3 ki\u1EC3m tra.",
      -1
    )
  ),
  Wv = { key: 0, class: "flex mt-2" },
  qv = Dt(() =>
    h(
      "span",
      { class: "text-sm text-center" },
      "Vui l\xF2ng ch\u1EDD ki\u1EC3m tra....",
      -1
    )
  ),
  Kv = [qv],
  Yv = { key: 1, class: "flex mt-2" },
  Gv = { class: "text-sm text-center" },
  Xv = Dt(() =>
    h(
      "div",
      { class: "alert alert-info text-left mt-5" },
      " N\u1EBFu c\xF3 l\u1ED7i, h\xE3y li\xEAn h\u1EC7 c\xE1c k\xEAnh CSKH b\xEAn d\u01B0\u1EDBi ho\u1EB7c nh\u1EA5n v\xE0o n\xFAt li\xEAn h\u1EC7 g\xF3c ph\u1EA3i m\xE0n h\xECnh \u0111\u1EC3 b\xE1o l\u1ED7i ADMIN ",
      -1
    )
  ),
  Jv = { id: "contact", class: "mt-5 mb-5" },
  Qv = ["href"],
  Zv = Dt(() =>
    h(
      "span",
      { class: "btn btn-info text-uppercase" },
      "Tele h\u1ED7 tr\u1EE3",
      -1
    )
  ),
  eb = [Zv],
  tb = ["href"],
  nb = Dt(() =>
    h(
      "span",
      { class: "btn btn-info text-uppercase" },
      "Group giao l\u01B0u",
      -1
    )
  ),
  rb = [nb];
function ab(e, t, n, r, a, i) {
  return (
    J(),
    pe("div", Lv, [
      h("div", Dv, [
        Fv,
        h("div", jv, [
          Bv,
          h("div", Uv, [
            h("div", zv, [
              Hv,
              ku(
                h(
                  "input",
                  {
                    type: "number",
                    class: "form-control",
                    "onUpdate:modelValue": t[0] || (t[0] = (s) => (a.code = s)),
                    placeholder:
                      "M\xE3 giao d\u1ECBch: V\xED d\u1EE5 11223344556",
                  },
                  null,
                  512
                ),
                [[Rd, a.code]]
              ),
              Vv,
            ]),
            h(
              "button",
              {
                class: "btn btn-primary mb-2",
                onClick:
                  t[1] || (t[1] = (...s) => i.checkMGD && i.checkMGD(...s)),
              },
              "Ki\u1EC3m tra"
            ),
            a.loading ? (J(), pe("div", Wv, Kv)) : Tr("", !0),
            a.message.length > 0
              ? (J(), pe("div", Yv, [h("span", Gv, Z(a.message), 1)]))
              : Tr("", !0),
          ]),
          h("div", null, [
            Xv,
            h("div", Jv, [
              h(
                "a",
                {
                  class: "text-white mr-3",
                  href: n.website.telegram,
                  target: "_blank",
                },
                eb,
                8,
                Qv
              ),
              h(
                "a",
                { class: "text-white", href: n.website.zalo, target: "_blank" },
                rb,
                8,
                tb
              ),
            ]),
          ]),
        ]),
      ]),
    ])
  );
}
var ib = Lt(Mv, [
  ["render", ab],
  ["__scopeId", "data-v-143cd333"],
]);
const sb = {
    props: { data: { type: Array } },
    methods: {
      formatVND(e) {
        return e.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
      },
    },
  },
  ob = { class: "mt-5 text-center panel panel-primary" },
  lb = { class: "row" },
  cb = { class: "col-md-12 mt-3" },
  fb = h(
    "div",
    { class: "text-center mb-3" },
    [h("h3", { class: "text-uppercase" }, " L\u1ECBch s\u1EED tham gia ")],
    -1
  ),
  ub = { class: "table-responsive" },
  db = { class: "table table-striped table-bordered table-hover text-center" },
  hb = h(
    "thead",
    null,
    [
      h("tr", { class: "bg-primary", role: "row" }, [
        h(
          "th",
          { class: "text-center text-white" },
          " S\u1ED1 \u0111i\u1EC7n tho\u1EA1i "
        ),
        h(
          "th",
          { class: "text-center text-white" },
          " Ti\u1EC1n c\u01B0\u1EE3c "
        ),
        h("th", { class: "text-center text-white" }, " N\u1ED9i dung "),
        h("th", { class: "text-center text-white" }, " Tr\u1EA1ng th\xE1i "),
      ]),
    ],
    -1
  ),
  mb = { id: "history" },
  pb = { class: "fa-stack" },
  gb = h("span", { class: "fa fa-circle fa-stack-2x" }, null, -1),
  vb = { class: "fa-stack-1x text-white" },
  bb = h(
    "td",
    null,
    [h("span", { class: "label label-success text-uppercase" }, "Th\u1EAFng")],
    -1
  );
function yb(e, t, n, r, a, i) {
  return (
    J(),
    pe("div", ob, [
      h("div", lb, [
        h("div", cb, [
          fb,
          h("div", ub, [
            h("table", db, [
              hb,
              h("tbody", mb, [
                (J(!0),
                pe(
                  ye,
                  null,
                  Kt(
                    n.data,
                    (s, o) => (
                      J(),
                      pe("tr", { key: o }, [
                        h("td", null, Z(s.phone), 1),
                        h("td", null, Z(i.formatVND(s.money)) + " VN\u0110", 1),
                        h("td", null, [
                          h("span", pb, [gb, h("span", vb, Z(s.comment), 1)]),
                        ]),
                        bb,
                      ])
                    )
                  ),
                  128
                )),
              ]),
            ]),
          ]),
        ]),
      ]),
    ])
  );
}
var _b = Lt(sb, [["render", yb]]);
const xb = {
    props: { data: { type: Array }, webConfig: { type: Object } },
    mounted() {
      const e = document.querySelectorAll(".bg-amber-700");
      this.webConfig.color &&
        e.forEach((t) => {
          t.style.backgroundColor = this.webConfig.color;
        });
    },
    methods: {
      formatVND(e) {
        return e.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
      },
    },
  },
  wb = { class: "panel panel-primary week_top" },
  Eb = h(
    "div",
    { class: "panel-heading text-center" },
    [h("h4", null, "TOP TU\u1EA6N")],
    -1
  ),
  Cb = { class: "panel-body" },
  kb = { class: "table-responsive" },
  Ab = { class: "table table-striped table-bordered table-hover text-center" },
  Ob = h(
    "thead",
    null,
    [
      h("tr", { role: "row", class: "bg-primary" }, [
        h("th", { class: "text-center text-white" }, "TOP"),
        h(
          "th",
          { class: "text-center text-white" },
          "S\u1ED1 \u0111i\u1EC7n tho\u1EA1i"
        ),
        h("th", { class: "text-center text-white" }, "S\u1ED1 ti\u1EC1n"),
        h(
          "th",
          { class: "text-center text-white" },
          "Ph\u1EA7n th\u01B0\u1EDFng"
        ),
      ]),
    ],
    -1
  ),
  Sb = {
    role: "alert",
    "aria-live": "polite",
    "aria-relevant": "all",
    id: "week_top",
    class: "text-center",
  },
  Tb = h(
    "td",
    { class: "col-xs-1" },
    [
      h("span", { class: "fa-stack" }, [
        h("span", { class: "fa fa-circle fa-stack-2x text-danger" }),
        h("strong", { class: "fa-stack-1x text-white" }, "1"),
      ]),
    ],
    -1
  ),
  Pb = { class: "col-xs-3" },
  $b = { class: "label label-success" },
  Rb = { class: "col-xs-4 text-center" },
  Nb = { class: "label label-danger" },
  Ib = { class: "col-xs-4 text-center" },
  Mb = { class: "label label-danger" },
  Lb = h(
    "td",
    null,
    [
      h("span", { class: "fa-stack" }, [
        h("span", { class: "fa fa-circle fa-stack-2x text-danger" }),
        h("strong", { class: "fa-stack-1x text-white" }, "2"),
      ]),
    ],
    -1
  ),
  Db = { class: "col-xs-2" },
  Fb = { class: "label label-success" },
  jb = { class: "col-xs-5 text-center" },
  Bb = { class: "label label-danger" },
  Ub = { class: "col-xs-5 text-center" },
  zb = { class: "label label-danger" },
  Hb = h(
    "td",
    null,
    [
      h("span", { class: "fa-stack" }, [
        h("span", { class: "fa fa-circle fa-stack-2x text-danger" }),
        h("strong", { class: "fa-stack-1x text-white" }, "3"),
      ]),
    ],
    -1
  ),
  Vb = { class: "col-xs-2" },
  Wb = { class: "label label-success" },
  qb = { class: "col-xs-5 text-center" },
  Kb = { class: "label label-danger" },
  Yb = { class: "col-xs-5 text-center" },
  Gb = { class: "label label-danger" },
  Xb = h(
    "td",
    null,
    [
      h("span", { class: "fa-stack" }, [
        h("span", { class: "fa fa-circle fa-stack-2x text-danger" }),
        h("strong", { class: "fa-stack-1x text-white" }, "4"),
      ]),
    ],
    -1
  ),
  Jb = { class: "col-xs-2" },
  Qb = { class: "label label-success" },
  Zb = { class: "col-xs-5 text-center" },
  ey = { class: "label label-danger" },
  ty = { class: "col-xs-5 text-center" },
  ny = { class: "label label-danger" },
  ry = h(
    "td",
    null,
    [
      h("span", { class: "fa-stack" }, [
        h("span", { class: "fa fa-circle fa-stack-2x text-danger" }),
        h("strong", { class: "fa-stack-1x text-white" }, "5"),
      ]),
    ],
    -1
  ),
  ay = { class: "col-xs-2" },
  iy = { class: "label label-success" },
  sy = { class: "col-xs-5 text-center" },
  oy = { class: "label label-danger" },
  ly = { class: "col-xs-5 text-center" },
  cy = { class: "label label-danger" },
  fy = h(
    "div",
    { class: "text-center" },
    [
      h(
        "b",
        { class: "text-danger" },
        "Ph\u1EA7n th\u01B0\u1EDFng TOP s\u1EBD d\u01B0\u1EE3c trao v\xE0o 23:59 Ch\u1EE7 Nh\u1EADt h\xE0ng tu\u1EA7n."
      ),
    ],
    -1
  );
function uy(e, t, n, r, a, i) {
  var s, o, l, f, c, u, m, g, E, T;
  return (
    J(),
    pe("div", wb, [
      Eb,
      h("div", Cb, [
        h("div", kb, [
          h("table", Ab, [
            Ob,
            h("tbody", Sb, [
              h("tr", null, [
                Tb,
                h("td", Pb, [
                  h(
                    "span",
                    $b,
                    Z(
                      ((s = n.data[0]) == null ? void 0 : s.phone) ||
                        "000000000"
                    ),
                    1
                  ),
                ]),
                h("td", Rb, [
                  h(
                    "span",
                    Nb,
                    Z(
                      i.formatVND(
                        ((o = n.data[0]) == null ? void 0 : o.money) || "0"
                      )
                    ) + " VND",
                    1
                  ),
                ]),
                h("td", Ib, [
                  h("span", Mb, Z(i.formatVND(n.webConfig.top_1)) + " VND", 1),
                ]),
              ]),
              h("tr", null, [
                Lb,
                h("td", Db, [
                  h(
                    "span",
                    Fb,
                    Z(
                      ((l = n.data[1]) == null ? void 0 : l.phone) ||
                        "000000000"
                    ),
                    1
                  ),
                ]),
                h("td", jb, [
                  h(
                    "span",
                    Bb,
                    Z(
                      i.formatVND(
                        ((f = n.data[1]) == null ? void 0 : f.money) || "0"
                      )
                    ) + " VND",
                    1
                  ),
                ]),
                h("td", Ub, [
                  h("span", zb, Z(i.formatVND(n.webConfig.top_2)) + " VND", 1),
                ]),
              ]),
              h("tr", null, [
                Hb,
                h("td", Vb, [
                  h(
                    "span",
                    Wb,
                    Z(
                      ((c = n.data[2]) == null ? void 0 : c.phone) ||
                        "000000000"
                    ),
                    1
                  ),
                ]),
                h("td", qb, [
                  h(
                    "span",
                    Kb,
                    Z(
                      i.formatVND(
                        ((u = n.data[2]) == null ? void 0 : u.money) || "0"
                      )
                    ) + " VND",
                    1
                  ),
                ]),
                h("td", Yb, [
                  h("span", Gb, Z(i.formatVND(n.webConfig.top_3)) + " VND", 1),
                ]),
              ]),
              h("tr", null, [
                Xb,
                h("td", Jb, [
                  h(
                    "span",
                    Qb,
                    Z(
                      ((m = n.data[3]) == null ? void 0 : m.phone) ||
                        "000000000"
                    ),
                    1
                  ),
                ]),
                h("td", Zb, [
                  h(
                    "span",
                    ey,
                    Z(
                      i.formatVND(
                        ((g = n.data[3]) == null ? void 0 : g.money) || "0"
                      )
                    ) + " VND",
                    1
                  ),
                ]),
                h("td", ty, [
                  h("span", ny, Z(i.formatVND(n.webConfig.top_4)) + " VND", 1),
                ]),
              ]),
              h("tr", null, [
                ry,
                h("td", ay, [
                  h(
                    "span",
                    iy,
                    Z(
                      ((E = n.data[4]) == null ? void 0 : E.phone) ||
                        "000000000"
                    ),
                    1
                  ),
                ]),
                h("td", sy, [
                  h(
                    "span",
                    oy,
                    Z(
                      i.formatVND(
                        ((T = n.data[4]) == null ? void 0 : T.money) || "0"
                      )
                    ) + " VND",
                    1
                  ),
                ]),
                h("td", ly, [
                  h("span", cy, Z(i.formatVND(n.webConfig.top_5)) + " VND", 1),
                ]),
              ]),
            ]),
          ]),
          fy,
        ]),
      ]),
    ])
  );
}
var dy = Lt(xb, [["render", uy]]);
const hy = {
    props: {
      data: { type: Array, default: [] },
      tab: { type: Number, default: 0 },
      infoPhone: { type: Array, default: [] },
    },
    data() {
      
      // const phone_t = Object.entries(this.data[0].phone);
      // console.log(phone_t);
      return {
        phones: [],
        infoGame: [],
        textGame: this.data[0].description,
      };
    },
    mounted() {
      const e = this.data.find((n) => n.id == this.tab);
      (this.textGame = e.description), (this.infoGame = e.rule);
      const t = e.phone;
      (this.phones = t.map((n) => {
        const r = this.infoPhone.find((a) => a.phone == n);
        return {
          phone: n,
          min: r.min,
          max: r.max,
          money_day: r.money_day,
          total_day: r.total_day,
        };
      })),
        setInterval(() => {
          let n = document.querySelectorAll(".total_day"),
            r = document.querySelectorAll(".money_day");
          n.forEach((a) => {
            let i = a.style.display;
            a.style.display = i == "none" ? "block" : "none";
          }),
            r.forEach((a) => {
              let i = a.style.display;
              a.style.display = i == "none" ? "block" : "none";
            });
        }, 4e3);
    },
    methods: {
      async copyPhone(e) {
        await navigator.clipboard.writeText(e),
          this.$notify({
            title: "Copy th\xE0nh c\xF4ng",
            text: "Ch\xFAc b\u1EA1n ch\u01A1i game vui v\u1EBB!",
            type: "success",
          });
      },
      formatVND(e) {
        return e.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
      },
      nFormatter(e, t) {
        const n = [
            { value: 1, symbol: "" },
            { value: 1e3, symbol: "K" },
            { value: 1e6, symbol: "M" },
            { value: 1e9, symbol: "G" },
            { value: 1e12, symbol: "T" },
            { value: 1e15, symbol: "P" },
            { value: 1e18, symbol: "E" },
          ],
          r = /\.0+$|(\.[0-9]*[1-9])0+$/;
        var a = n
          .slice()
          .reverse()
          .find(function (i) {
            return e >= i.value;
          });
        return a ? (e / a.value).toFixed(t).replace(r, "$1") + a.symbol : "0";
      },
    },
    watch: {
      tab: function (e, t) {
        const n = this.data.find((a) => a.id == e);
        (this.textGame = n.description), (this.infoGame = n.rule);
        const r = n.phone;
        this.phones = r.map((a) => {
          const i = this.infoPhone.find((s) => s.phone == a);
          return {
            phone: a,
            min: i.min,
            max: i.max,
            money_day: i.money_day,
            total_day: i.total_day,
          };
        });
      },
    },
  },
  my = {
    class: "col-md-6 mt-3 cl animate__animated animate__fadeInUp animate__slow",
    id: "playing",
  },
  py = { class: "panel panel-primary" },
  gy = h(
    "div",
    { class: "panel-heading text-center" },
    " C\xE1ch ch\u01A1i ",
    -1
  ),
  vy = { class: "play-rules" },
  by = {
    class: "panel-body",
    style: { "padding-top": "10px", "padding-bottom": "20px" },
  },
  yy = ["innerHTML"],
  _y = h(
    "p",
    null,
    "-C\xE1ch ch\u01A1i v\xF4 c\xF9ng \u0111\u01A1n gi\u1EA3n :",
    -1
  ),
  xy = h(
    "p",
    null,
    "- Chuy\u1EC3n ti\u1EC1n v\xE0o m\u1ED9t trong c\xE1c t\xE0i kho\u1EA3n:",
    -1
  ),
  wy = { class: "table-responsive" },
  Ey = {
    class: "table table-striped table-bordered table-hover text-center mb-0",
  },
  Cy = h(
    "thead",
    null,
    [
      h("tr", null, [
        h(
          "th",
          { class: "text-center text-white bg-primary" },
          "S\u1ED1 \u0111i\u1EC7n tho\u1EA1i"
        ),
        h(
          "th",
          { class: "text-center text-white bg-primary" },
          "T\u1ED1i thi\u1EC3u"
        ),
        h(
          "th",
          { class: "text-center text-white bg-primary" },
          "T\u1ED1i \u0111a"
        ),
      ]),
    ],
    -1
  ),
  ky = {
    "aria-live": "polite",
    "aria-relevant": "all",
    class: "result-table-10",
    role: "alert",
  },
  Ay = { id: "mln" },
  Oy = { id: "hmln", "attr-name": "amount", class: "" },
  Sy = { style: { "font-size": "9px" }, class: "money_day" },
  Ty = { style: { color: "green" } },
  Py = Pe("/ "),
  $y = h("span", { style: { color: "cornflowerblue" } }, "50M", -1),
  Ry = { style: { "font-size": "9px", display: "none" }, class: "total_day" },
  Ny = { style: { color: "red" } },
  Iy = Pe("/"),
  My = h("span", { style: { color: "cornflowerblue" } }, "50M", -1),
  Ly = ["onClick"],
  Dy = h("i", { class: "fa fa-clipboard", "aria-hidden": "true" }, null, -1),
  Fy = [Dy],
  jy = ["onClick"],
  By = h("i", { class: "fa fa-play", "aria-hidden": "true" }, null, -1),
  Uy = [By],
  zy = h("div", { class: "text-center font-weight-bold" }, null, -1),
  Hy = h("p", { class: "mt-3" }, " - N\u1ED9i dung chuy\u1EC3n: ", -1),
  Vy = { class: "table-responsive" },
  Wy = { class: "table table-striped table-bordered table-hover text-center" },
  qy = h(
    "thead",
    null,
    [
      h("tr", null, [
        h(
          "th",
          { class: "text-center text-white bg-primary" },
          "Mã Đuôi"
        ),
        h("th", { class: "text-center text-white bg-primary" }, "S\u1ED1"),
        h(
          "th",
          { class: "text-center text-white bg-primary" },
          "T\u1EC9 l\u1EC7"
        ),
      ]),
    ],
    -1
  ),
  Ky = {
    "aria-live": "polite",
    "aria-relevant": "all",
    class: "",
    id: "result-table",
    role: "alert",
  },
  Yy = { class: "fa-stack" },
  Gy = h(
    "span",
    { class: "fa fa-circle fa-stack-2x", style: "color: " },
    null,
    -1
  ),
  Xy = { class: "fa-stack-1x text-white" },
  Jy = Pe(" - Ti\u1EC1n th\u1EAFng s\u1EBD = "),
  Qy = h("b", null, "Ti\u1EC1n c\u01B0\u1EE3c * t\u1EC9 l\u1EC7", -1),
  Zy = h("br", null, null, -1),
  e1 = Pe(),
  t1 = h(
    "b",
    null,
    '- L\u01B0u \xFD : M\u1EE9c c\u01B0\u1EE3c m\u1ED7i s\u1ED1 kh\xE1c nhau, n\u1EBFu chuy\u1EC3n sai h\u1EA1n m\u1EE9c ho\u1EB7c sai n\u1ED9i dung vui l\xF2ng "li\xEAn h\u1EC7 ADMIN" \u0111\u1EC3 \u0111\u01B0\u1EE3c x\u1EED l\xED',
    -1
  ),
  n1 = h("div", { class: "minigame-rules" }, null, -1);
function r1(e, t, n, r, a, i) {
  return (
    J(),
    pe("div", my, [
      h("div", py, [
        gy,
        h("div", vy, [
          h("div", by, [
            h("p", { innerHTML: a.textGame }, null, 8, yy),
            _y,
            xy,
            h("div", wy, [
              h("table", Ey, [
                Cy,
                h("tbody", ky, [
                  (J(!0),
                  pe(
                    ye,
                    null,
                    Kt(
                      a.phones,
                      (s, o) => (
                        J(),
                        pe("tr", { key: o }, [
                          h("td", null, [
                            h("b", Ay, [
                              Pe(Z(s.phone), 1),
                              h("b", Oy, [
                                h("span", Sy, [
                                  h(
                                    "span",
                                    Ty,
                                    Z(i.nFormatter(s.money_day, 1)),
                                    1
                                  ),
                                  Py,
                                  $y,
                                ]),
                                h("span", Ry, [
                                  h(
                                    "span",
                                    Ny,
                                    Z(i.nFormatter(s.money_day, 1)),
                                    1
                                  ),
                                  Iy,
                                  My,
                                ]),
                              ]),
                            ]),
                            h(
                              "span",
                              {
                                class: "label label-success text-uppercase",
                                style: {
                                  "margin-left": "5px",
                                  "margin-right": "5px",
                                },
                                onClick: (l) => i.copyPhone(s.phone),
                              },
                              Fy,
                              8,
                              Ly
                            ),
                            h(
                              "span",
                              {
                                class: "label label-success text-uppercase",
                                onClick: (l) => i.copyPhone(s.phone),
                              },
                              Uy,
                              8,
                              jy
                            ),
                          ]),
                          h("td", null, Z(i.formatVND(s.min)) + " VN\u0110", 1),
                          h("td", null, Z(i.formatVND(s.max)) + " VN\u0110", 1),
                        ])
                      )
                    ),
                    128
                  )),
                ]),
              ]),
            ]),
            zy,
            Hy,
            h("div", Vy, [
              h("table", Wy, [
                qy,
                h("tbody", Ky, [
                  (J(!0),
                  pe(
                    ye,
                    null,
                    Kt(
                      a.infoGame,
                      (s, o) => (
                        J(),
                        pe("tr", { key: o }, [
                          h("td", null, [
                            h("span", Yy, [Gy, h("span", Xy, Z(s.comment), 1)]),
                          ]),
                          h("td", null, [
                            (J(!0),
                            pe(
                              ye,
                              null,
                              Kt(
                                s.number,
                                (l, f) => (
                                  J(),
                                  pe("span", { key: f }, [
                                    h("code", null, Z(l), 1),
                                    Pe(
                                      " " +
                                        Z(s.number.length - 1 == f ? "" : "-"),
                                      1
                                    ),
                                  ])
                                )
                              ),
                              128
                            )),
                          ]),
                          h("td", null, [h("b", null, "x" + Z(s.tile), 1)]),
                        ])
                      )
                    ),
                    128
                  )),
                ]),
              ]),
            ]),
            Jy,
            Qy,
            Zy,
            e1,
            t1,
          ]),
        ]),
        n1,
      ]),
    ])
  );
}
var a1 = Lt(hy, [["render", r1]]);
const i1 = {
    props: { data: { type: Array, default: [] } },
    methods: {
      async copyPhone(e) {
        await navigator.clipboard.writeText(e),
          this.$notify({
            title: "Copy th\xE0nh c\xF4ng",
            text: "Ch\xFAc b\u1EA1n ch\u01A1i game vui v\u1EBB!",
            type: "success",
          });
      },
      formatVND(e) {
        return e.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
      },
    },
  },
  s1 = { class: "mt-5 text-center panel panel-primary" },
  o1 = { class: "row" },
  l1 = { class: "col-md-12 mt-3" },
  c1 = h(
    "div",
    { class: "text-center mb-3" },
    [h("h3", { class: "text-uppercase" }, " TR\u1EA0NG TH\xC1I ZaloPay ")],
    -1
  ),
  f1 = { class: "table-responsive" },
  u1 = { class: "table table-striped table-bordered table-hover text-center" },
  d1 = h(
    "thead",
    null,
    [
      h("tr", { class: "bg-primary", role: "row" }, [
        h(
          "th",
          { class: "text-center text-white" },
          " S\u1ED1 \u0111i\u1EC7n tho\u1EA1i "
        ),
        h("th", { class: "text-center text-white" }, " Tr\u1EA1ng th\xE1i "),
        h("th", { class: "text-center text-white" }, " Giao d\u1ECBch "),
        h("th", { class: "text-center text-white" }, " H\u1EA1n m\u1EE9c "),
      ]),
    ],
    -1
  ),
  h1 = { id: "momo-status" },
  m1 = ["onClick"],
  p1 = h("i", { class: "fa fa-clipboard", "aria-hidden": "true" }, null, -1),
  g1 = [p1],
  v1 = Pe(),
  b1 = ["onClick"],
  y1 = h("i", { class: "fa fa-play", "aria-hidden": "true" }, null, -1),
  _1 = [y1],
  x1 = h(
    "td",
    null,
    [
      h(
        "span",
        { class: "label label-success text-uppercase" },
        "Ho\u1EA1t \u0111\u1ED9ng"
      ),
    ],
    -1
  ),
  w1 = h(
    "td",
    null,
    [
      h("strong", null, [
        h("span", { class: "text-danger" }, "Kh\xF4ng gi\u1EDBi h\u1EA1n"),
      ]),
    ],
    -1
  ),
  E1 = { class: "text-danger cash-format" },
  C1 = Pe(" / 50.000.000 VND");
function k1(e, t, n, r, a, i) {
  return (
    J(),
    pe("div", s1, [
      h("div", o1, [
        h("div", l1, [
          c1,
          h("div", f1, [
            h("table", u1, [
              d1,
              h("tbody", h1, [
                (J(!0),
                pe(
                  ye,
                  null,
                  Kt(
                    n.data,
                    (s, o) => (
                      J(),
                      pe("tr", { key: o }, [
                        h("td", null, [
                          Pe(Z(s.phone) + " ", 1),
                          h(
                            "span",
                            {
                              class: "label label-success text-uppercase",
                              onClick: (l) => i.copyPhone(s.phone),
                            },
                            g1,
                            8,
                            m1
                          ),
                          v1,
                          h(
                            "span",
                            {
                              class: "label label-success text-uppercase",
                              onClick: (l) => i.copyPhone(s.phone),
                            },
                            _1,
                            8,
                            b1
                          ),
                        ]),
                        x1,
                        w1,
                        h("td", null, [
                          h("strong", null, [
                            h(
                              "span",
                              E1,
                              Z(i.formatVND(s.money_day)) + " VND",
                              1
                            ),
                            C1,
                          ]),
                        ]),
                      ])
                    )
                  ),
                  128
                )),
              ]),
            ]),
          ]),
        ]),
      ]),
    ])
  );
}
var A1 = Lt(i1, [["render", k1]]);
const O1 = { key: 0 },
  S1 = { key: 1 },
  T1 = { class: "container" },
  P1 = { class: "content" },
  $1 = { class: "content-container" },
  R1 = Oi(
    '<div class="py-5" style="min-height:80px !important;"><div class="output" id="output"><h3 class="cursor"> H\u1EC7 Th\u1ED1ng Mini Game ZaloPay T\u1EF1 \u0110\u1ED9ng Si\xEAu Ngon </h3><h4>Uy T\xEDn - Giao d\u1ECBch T\u1EF1 \u0110\u1ED9ng 24/7 - Tr\u1EA3 th\u01B0\u1EDFng 10s! </h4></div></div><div class="text-center mt-3"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noteModal">Xem L\u01B0u \xDD</button></div>',
    2
  ),
  N1 = { class: "text-center mt-5", role: "group" },
  I1 = {
    class: "btn btn btn-outline-primary mt-1 p-3",
    style: { position: "relative" },
    "data-toggle": "modal",
    "data-target": "#codeModal",
  },
  M1 = Pe(" Nh\u1EADp CODE Khuy\u1EBFn M\xE3i "),
  L1 = {
    class: "text-danger",
    style: {
      position: "absolute",
      "margin-left": "auto",
      "margin-right": "auto",
      "text-align": "center",
      left: "0px",
      right: "0px",
      top: "2px",
      "font-size": "9px",
    },
  },
  D1 = Pe("(NEW)"),
  F1 = { class: "row justify-content-md-center box-cl" },
  j1 = Oi(
    '<footer class="footer"><div class="container text-center"><div class="row"><div class="col-xs-12 text-white"> Copyright 2023 \xA9 <a href="#" target="_blank" style="color:red;">MService</a> d\u1ECBch v\u1EE5 Server ZaloPay | All rights reserved </div></div></div></footer>',
    1
  ),
  B1 = {
    class: "modal fade",
    id: "codeModal",
    tabindex: "-1",
    role: "dialog",
    "aria-labelledby": "codeModalLabel",
    "aria-hidden": "true",
  },
  U1 = { class: "modal-dialog", role: "document" },
  z1 = { class: "modal-content" },
  H1 = h(
    "div",
    { class: "modal-header" },
    [
      h(
        "h4",
        {
          class: "modal-title text-center text-bold text-success",
          id: "codeModalLabel",
        },
        "CODE KHUY\u1EBEN M\u1EA0I "
      ),
      h(
        "button",
        {
          type: "button",
          class: "close",
          "data-dismiss": "modal",
          "aria-label": "Close",
        },
        [h("span", { "aria-hidden": "true" }, "\xD7")]
      ),
    ],
    -1
  ),
  V1 = { class: "modal-body", id: "note_modal" },
  W1 = { class: "form-horizontal modalCode", role: "form" },
  q1 = Oi(
    '<div class="form-group text-center"><label class="control-label" for="code">M\xE3 Code</label><input type="text" class="form-control" id="code" placeholder="ABC123"></div><div class="form-group text-center"><label class="control-label" for="phone">S\u1ED1 \u0111i\u1EC7n tho\u1EA1i</label><input type="text" class="form-control" id="phone" placeholder="0987xxxxxx"><p style="font-size:12px;margin-top:5px;color:red;">Nh\u1EADp s\u1ED1 \u0111i\u1EC7n tho\u1EA1i c\u1EE7a b\u1EA1n \u0111\u1EC3 ki\u1EC3m tra v\xE0 nh\u1EADn th\u01B0\u1EDFng!</p></div>',
    2
  ),
  K1 = { class: "form-group text-center" },
  Y1 = h(
    "div",
    { class: "alert alert-info" },
    [
      Pe(
        " 1. M\u1ED9t s\u1ED1 \u0111i\u1EC7n tho\u1EA1i ch\u1EC9 \u0111\u01B0\u1EE3c nh\u1EADp 1 m\xE3/ng\xE0y. "
      ),
      h("br"),
      Pe(
        " 2. M\xE3 code khuy\u1EBFn m\u1EA1i s\u1EBD t\xF9y v\xE0o \u0111i\u1EC1u ki\u1EC7n \u0111\u1EC3 s\u1EED d\u1EE5ng, c\xF3 th\u1EDDi h\u1EA1n."
      ),
      h("br"),
      Pe(
        " 3. M\xE3 code khuy\u1EBFn m\u1EA1i s\u1EBD \u0111\u01B0\u1EE3c c\u1EA5p theo c\xE1c ch\u01B0\u01A1ng tr\xECnh khuy\u1EBFn m\u1EA1i c\u1EE7a h\u1EC7 th\u1ED1ng ZaloPay."
      ),
      h("br"),
      Pe(
        " 4. Vui l\xF2ng li\xEAn h\u1EC7 ch\xE1t CSKH \u0111\u1EC3 bi\u1EBFt th\xEAm chi t\u1EBFt khi b\u1EA1n nh\u1EADn \u0111\u01B0\u1EE3c CODE."
      ),
      h("br"),
    ],
    -1
  ),
  G1 = h(
    "div",
    { class: "modal-footer" },
    [
      h(
        "button",
        { type: "button", class: "btn btn-secondary", "data-dismiss": "modal" },
        "T\u1EAFt"
      ),
    ],
    -1
  ),
  X1 = {
    class: "modal fade",
    id: "noteModal",
    tabindex: "-1",
    role: "dialog",
    "aria-labelledby": "noteModalLabel",
    "aria-hidden": "true",
  },
  J1 = { class: "modal-dialog", role: "document" },
  Q1 = { class: "modal-content" },
  Z1 = h(
    "div",
    { class: "modal-header" },
    [
      h(
        "h5",
        { class: "modal-title", id: "noteModalLabel" },
        "Th\xF4ng b\xE1o"
      ),
      h(
        "button",
        {
          type: "button",
          class: "close",
          "data-dismiss": "modal",
          "aria-label": "Close",
        },
        [h("span", { "aria-hidden": "true" }, "\xD7")]
      ),
    ],
    -1
  ),
  e0 = { class: "modal-body", id: "note_modal" },
  t0 = ["innerHTML"],
  n0 = h(
    "div",
    { class: "modal-footer" },
    [
      h(
        "button",
        { type: "button", class: "btn btn-secondary", "data-dismiss": "modal" },
        "\u0110\xE3 hi\u1EC3u"
      ),
    ],
    -1
  ),
  r0 = {
    data() {
      return {
        isLoading: !0,
        tab: 0,
        game: [],
        history: [],
        top: [],
        statusPhone: [],
        dataWebsite: {
          notification: "",
          zalo: "",
          telegram: "",
          top_1: "100000",
          top_2: "100000",
          top_3: "100000",
          top_4: "100000",
          top_5: "100000",
          logo: "",
          color: "",
        },
        code: "",
        phone: "",
        checkClick: !1,
      };
    },
    created() {
      this.getDataWeb().then(() => {
        this.isLoading = !1;
      });
    },
    mounted() {
      setInterval(() => {
        this.getDataWeb();
      }, 2e4);
    },
    methods: {
      changeGame(e) {
        this.tab = e;
      },
      async getDataWeb() {
        const e = "/api/data.php",
          { data: t } = await si.get(e);
        (this.game = t.game),
          (this.history = t.history),
          (this.top = t.top),
          (this.statusPhone = t.min_max_phone),
          (this.dataWebsite = t.website),
          this.dataWebsite.color != "" &&
            document.documentElement.style.setProperty(
              "--main-color",
              this.dataWebsite.color
            );
      },
      async postGiftCode() {
        try {
          if (this.checkClick) return;
          this.checkClick = !0;
          const e = document.querySelector("#code").value,
            t = document.querySelector("#phone").value,
            n = "/api/gift-code.php",
            { data: r } = await si.post(n, { code: e, phone: t });
          r.status == 1, alert(r.message), (this.checkClick = !1);
        } catch {
          alert(
            "L\u1ED7i h\u1EC7 th\u1ED1ng, vui l\xF2ng th\u1EED l\u1EA1i sau!"
          );
        }
      },
    },
  },
  Uo = Object.assign(r0, {
    __name: "Home",
    setup(e) {
      return (t, n) => {
        const r = In("font");
        return (
          J(),
          pe(
            ye,
            null,
            [
              t.isLoading
                ? (J(), pe("div", O1))
                : (J(),
                  pe("main", S1, [
                    ne(fg, { logo: t.dataWebsite.logo }, null, 8, ["logo"]),
                    h("div", T1, [
                      h("div", P1, [
                        h("div", $1, [
                          R1,
                          ne(
                            pg,
                            { onTabChange: t.changeGame, data: t.game },
                            null,
                            8,
                            ["onTabChange", "data"]
                          ),
                          h("div", N1, [
                            h("button", I1, [
                              M1,
                              h("b", L1, [
                                ne(
                                  r,
                                  { color: "red" },
                                  { default: Gt(() => [D1]), _: 1 }
                                ),
                              ]),
                            ]),
                          ]),
                          h("div", F1, [
                            ne(
                              a1,
                              {
                                data: t.game,
                                tab: t.tab,
                                infoPhone: t.statusPhone,
                              },
                              null,
                              8,
                              ["data", "tab", "infoPhone"]
                            ),
                            ne(
                              ib,
                              { data: t.statusPhone, website: t.dataWebsite },
                              null,
                              8,
                              ["data", "website"]
                            ),
                          ]),
                          ne(A1, { data: t.statusPhone }, null, 8, ["data"]),
                          ne(_b, { data: t.history }, null, 8, ["data"]),
                          ne(
                            dy,
                            { data: t.top, webConfig: t.dataWebsite },
                            null,
                            8,
                            ["data", "webConfig"]
                          ),
                        ]),
                      ]),
                    ]),
                    j1,
                    h("div", B1, [
                      h("div", U1, [
                        h("div", z1, [
                          H1,
                          h("div", V1, [
                            h("div", W1, [
                              q1,
                              h("div", K1, [
                                h(
                                  "button",
                                  {
                                    type: "submit",
                                    class: "btn btn-success",
                                    onClick:
                                      n[0] ||
                                      (n[0] = (...a) =>
                                        t.postGiftCode && t.postGiftCode(...a)),
                                  },
                                  Z(
                                    t.checkClick
                                      ? "Vui l\xF2ng ch\u1EDD..."
                                      : "Nh\u1EADn Ngay"
                                  ),
                                  1
                                ),
                              ]),
                            ]),
                            Y1,
                          ]),
                          G1,
                        ]),
                      ]),
                    ]),
                  ])),
              h("div", X1, [
                h("div", J1, [
                  h("div", Q1, [
                    Z1,
                    h("div", e0, [
                      h(
                        "div",
                        { innerHTML: t.dataWebsite.notification },
                        null,
                        8,
                        t0
                      ),
                    ]),
                    n0,
                  ]),
                ]),
              ]),
            ],
            64
          )
        );
      };
    },
  }),
  a0 = tg({
    history: gp("/"),
    routes: [
      { path: "/", name: "home", component: Uo },
      { path: "/:pathMatch(.*)*", name: "error", component: Uo },
    ],
  });
vm.add(Im);
const ca = Md(Qm);
ca.use(a0);
ca.use(Ym);
ca.component("font-awesome-icon", Nm);
ca.mount("#app");
