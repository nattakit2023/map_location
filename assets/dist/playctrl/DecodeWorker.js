(function (e) {
  var M = 0;
  var v = 1;
  var c = 2;
  var m = 100;
  var j = 101;
  var N = 1;
  var r = 48;
  var W = 31;
  var p = 16;
  importScripts("Decoder.js");
  Module.postRun.push(function () {
    postMessage({ function: "loaded" });
  });
  var q = 0;
  var x = false;
  var Q = false;
  var X = null;
  onmessage = function (e) {
    var r = e.data;
    var a = 0;
    switch (r.command) {
      case "SetStreamOpenMode":
        q = r.data;
        a = Module._SetStreamOpenMode(q);
        if (a !== N) {
          postMessage({ function: "SetStreamOpenMode", errorCode: a });
          return;
        }
        x = true;
        break;
      case "OpenStream":
        var l = r.dataSize;
        var t = Module._malloc(l + 4);
        if (t === null) {
          return;
        }
        var u = Module.HEAPU8.subarray(t, t + l);
        u.set(r.data);
        a = Module._OpenStream(t, l, r.bufPoolSize);
        postMessage({ function: "OpenStream", errorCode: a });
        if (a !== N) {
          Module._free(t);
          t = null;
          return;
        }
        Q = true;
        var n = new Uint32Array([l]);
        var o = new Uint8Array(n.buffer);
        var f = new Uint8Array(l + 4);
        f.set(o, 0);
        f.set(r.data, 4);
        n = null;
        o = null;
        u = Module.HEAPU8.subarray(t, t + l + 4);
        u.set(f);
        f = null;
        a = Module._InputData(t, l + 4);
        if (a !== N) {
          postMessage({ function: "InputData", errorCode: a });
          Module._free(t);
          t = null;
          return;
        }
        Module._free(t);
        t = null;
        if (X === null) {
          X = Module.cwrap("GetFrameData", "number");
        }
        if (q === 0) {
          X();
        }
        break;
      case "InputData":
        var d = r.dataSize;
        if (d > 0) {
          var i = Module._malloc(d);
          if (i === null) {
            return;
          }
          var s = new Uint8Array(r.data);
          Module.writeArrayToMemory(s, i);
          s = null;
          a = Module._InputData(i, d);
          if (a !== N) {
            if (a === 98) {
              a = 1;
            }
            postMessage({ function: "InputData", errorCode: a });
          }
          Module._free(i);
          pData = null;
        }
        if (X === null) {
          X = Module.cwrap("GetFrameData", "number");
        }
        while (x && Q) {
          var M = Y(X);
          if (j === M || W === M) {
            break;
          }
        }
        break;
      case "SetSecretKey":
        var v = r.nKeyLen;
        var c = Module._malloc(v);
        if (c === null) {
          return;
        }
        var m = r.data.length;
        var p = Z(r.data);
        var _ = Module.HEAPU8.subarray(c, c + v);
        _.set(new Uint8Array(p));
        a = Module._SetSecretKey(r.nKeyType, c, v, m);
        if (a !== N) {
          postMessage({ function: "SetSecretKey", errorCode: a });
          Module._free(c);
          c = null;
          return;
        }
        Module._free(c);
        c = null;
        break;
      case "GetBMP":
        var y = r.width;
        var g = r.height;
        var b = r.data;
        var S = (y * g * 3) / 2;
        var D = r.rect;
        var w = Module._malloc(S);
        if (w === null) {
          return;
        }
        Module.writeArrayToMemory(new Uint8Array(b, 0, S), w);
        var h = y * g * 4 + 60;
        var A = Module._malloc(h);
        var G = Module._malloc(4);
        if (A === null || G === null) {
          Module._free(w);
          w = null;
          if (A != null) {
            Module._free(A);
            A = null;
          }
          if (G != null) {
            Module._free(G);
            G = null;
          }
          return;
        }
        Module._memset(G, h, 4);
        a = Module._GetBMP(w, S, A, G, D.left, D.top, D.right, D.bottom);
        if (a !== N) {
          postMessage({ function: "GetBMP", errorCode: a });
          Module._free(w);
          w = null;
          Module._free(A);
          A = null;
          Module._free(G);
          G = null;
          return;
        }
        var C = Module.getValue(G, "i32");
        var U = new Uint8Array(C);
        U.set(Module.HEAPU8.subarray(A, A + C));
        postMessage({ function: "GetBMP", data: U, errorCode: a }, [U.buffer]);
        if (w != null) {
          Module._free(w);
          w = null;
        }
        if (A != null) {
          Module._free(A);
          A = null;
        }
        if (G != null) {
          Module._free(G);
          G = null;
        }
        break;
      case "GetJPEG":
        var P = r.width;
        var F = r.height;
        var I = r.data;
        var k = (P * F * 3) / 2;
        var E = r.rect;
        var T = Module._malloc(k);
        if (T === null) {
          return;
        }
        Module.writeArrayToMemory(new Uint8Array(I, 0, k), T);
        var B = Module._malloc(k);
        var H = Module._malloc(4);
        if (B === null || H === null) {
          if (B != null) {
            Module._free(B);
            B = null;
          }
          if (H != null) {
            Module._free(H);
            H = null;
          }
          if (T != null) {
            Module._free(T);
            T = null;
          }
          return;
        }
        Module.setValue(H, P * F * 2, "i32");
        a = Module._GetJPEG(T, k, B, H, E.left, E.top, E.right, E.bottom);
        if (a !== N) {
          postMessage({ function: "GetJPEG", errorCode: a });
          if (B != null) {
            Module._free(B);
            B = null;
          }
          if (H != null) {
            Module._free(H);
            H = null;
          }
          if (T != null) {
            Module._free(T);
            T = null;
          }
          return;
        }
        var O = Module.getValue(H, "i32");
        var R = new Uint8Array(O);
        R.set(Module.HEAPU8.subarray(B, B + O));
        postMessage({ function: "GetJPEG", data: R, errorCode: a }, [R.buffer]);
        ajpegSizeData = null;
        R = null;
        if (T != null) {
          Module._free(T);
          T = null;
        }
        if (B != null) {
          Module._free(B);
          B = null;
        }
        if (H != null) {
          Module._free(H);
          H = null;
        }
        break;
      case "SetDecodeFrameType":
        var z = r.data;
        a = Module._SetDecodeFrameType(z);
        if (a !== N) {
          postMessage({ function: "SetDecodeFrameType", errorCode: a });
          return;
        }
        break;
      case "DisplayRegion":
        var K = r.nRegionNum;
        var L = r.srcRect;
        var J = r.hDestWnd;
        var V = r.bEnable;
        a = Module._SetDisplayRegion(K, L, J, V);
        if (a !== N) {
          postMessage({ function: "DisplayRegion", errorCode: a });
          return;
        }
        break;
      case "CloseStream":
        a = Module._CloseStream();
        if (a !== N) {
          postMessage({ function: "CloseStream", errorCode: a });
          return;
        }
        break;
      case "SetIFrameDecInterval":
        Module._SetIFrameDecInterval(r.data);
        break;
      default:
        break;
    }
  };
  function _(e) {
    var r = e.year;
    var a = e.month;
    var l = e.day;
    var t = e.hour;
    var u = e.minute;
    var n = e.second;
    if (a < 10) {
      a = "0" + a;
    }
    if (l < 10) {
      l = "0" + l;
    }
    if (t < 10) {
      t = "0" + t;
    }
    if (u < 10) {
      u = "0" + u;
    }
    if (n < 10) {
      n = "0" + n;
    }
    return r + "-" + a + "-" + l + " " + t + ":" + u + ":" + n;
  }
  function Y(e) {
    var r = e();
    if (r === N) {
      var a = Module._GetFrameInfo();
      switch (a.frameType) {
        case M:
          var l = a.frameSize;
          if (0 === l) {
            return -1;
          }
          var t = Module._GetFrameBuffer();
          var u = new Uint8Array(l);
          u.set(Module.HEAPU8.subarray(t, t + l));
          postMessage(
            {
              function: "GetFrameData",
              type: "audioType",
              data: u.buffer,
              frameInfo: a,
              errorCode: r,
            },
            [u.buffer]
          );
          a = null;
          t = null;
          audioBuf = null;
          u = null;
          return m;
        case v:
          var n = _(a);
          var o = a.width;
          var f = a.height;
          var d = (o * f * 3) / 2;
          if (0 === d) {
            return -1;
          }
          var i = Module._GetFrameBuffer();
          var s = new Uint8Array(d);
          s.set(Module.HEAPU8.subarray(i, i + d));
          postMessage(
            {
              function: "GetFrameData",
              type: "videoType",
              data: s.buffer,
              dataLen: s.length,
              osd: n,
              frameInfo: a,
              errorCode: r,
            },
            [s.buffer]
          );
          a = null;
          i = null;
          buf = null;
          s = null;
          return j;
        case c:
          postMessage({
            function: "GetFrameData",
            type: "",
            data: null,
            dataLen: -1,
            osd: 0,
            frameInfo: null,
            errorCode: p,
          });
          return p;
        default:
          postMessage({
            function: "GetFrameData",
            type: "",
            data: null,
            dataLen: -1,
            osd: 0,
            frameInfo: null,
            errorCode: p,
          });
          return p;
      }
    } else {
      if (W === r || p === r) {
        postMessage({
          function: "GetFrameData",
          type: "",
          data: null,
          dataLen: -1,
          osd: 0,
          frameInfo: null,
          errorCode: r,
        });
      }
      return r;
    }
  }
  function a() {
    return new Date().getTime();
  }
  function l() {
    return new Date().getTime();
  }
  function Z(e) {
    var r,
      a,
      l = [];
    for (var t = 0; t < e.length; t++) {
      r = e.charCodeAt(t);
      a = [];
      do {
        a.push(r & 255);
        r = r >> 8;
      } while (r);
      l = l.concat(a.reverse());
    }
    return l;
  }
})();
