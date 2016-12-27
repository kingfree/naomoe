!
  function(e) {
    function t(i) {
      if (a[i]) return a[i].exports;
      var s = a[i] = {
        exports: {},
        id: i,
        loaded: !1
      };
      return e[i].call(s.exports, s, s.exports, t), s.loaded = !0, s.exports
    }
    var a = {};
    return t.m = e, t.c = a, t.p = "", t(0)
  }([function(e, t, a) {
    function i() {
      $.ajax({
        url: "/moe/2016/" + ajaxOpt.area + "/api/schedule/current.json?ts=" + (new Date).getTime(),
        success: function(e) {
          if (0 != e.code) return void S.alert({
            content: e.message
          });
          var t = e.result.title;
          if (ajaxOpt.match_type = e.result.type, !t) return void $(".content").css({
            marginBottom: 0
          }).append('<div style="color: #fff;font-size: 48px;">今日无赛</div>');
          switch (e.result.type) {
            case 4:
            case 2:
              if (y = [], $.each(e.result.voteGroups, function(t) {
                  y[t] = e.result.voteGroups[t].vote_num
                }), "1" == ajaxOpt.area) {
                var a = z;
                if (2 == e.result.type) var i = N;
                else var i = G;
                var l = M
              } else if (84 == e.result.duel_type || 42 == e.result.duel_type) var a = P,
                i = B,
                l = I;
              else var a = z,
                  i = A,
                  l = I;
              $(".vote-info-ticket-share").hide(), k = a, w = i, votepopuptpl = l, p(), $(".content").addClass("clearfix").append(k(e.result)), window.normallist = {};
              for (var o = 0; o < $(".match-show-vote").length; o++) normallist["s" + o] = [];
              s(t);
              break;
            case 3:
              if ("1" == ajaxOpt.area) {
                y = [], $.each(e.result.voteGroups, function(t) {
                  y[t] = e.result.voteGroups[t].vote_num
                });
                var a = P,
                  i = B,
                  l = I;
                $(".vote-info-ticket-share").hide(), k = a, w = i, votepopuptpl = l, g(), console.log(e.result.voteGroups), $(".content").addClass("clearfix").append(k(e.result)), window.normallist = {};
                for (var o = 0; o < $(".match-show-vote").length; o++) normallist["s" + o] = [];
                s(t)
              } else _(e.result.schedule_id, function(a) {
                y = [];
                var i = 0;
                $.each(e.result.voteGroups, function(t) {
                  y[t] = e.result.voteGroups[t].vote_num, $.each(e.result.voteGroups[t].characters, function(s) {
                    e.result.voteGroups[t].characters[s].static_cover = a[i].img, i++
                  })
                }), $("body").append('<div class="rolelist-list-checkmask"></div>');
                var l = L,
                  o = B,
                  r = I;
                $(".vote-info-ticket-share").hide(), k = l, w = o, votepopuptpl = r, g(), $(".content").addClass("clearfix").append(k(e.result)), $.each($(".rolelist-list"), function() {
                  $(this).find("li").eq(0).addClass("rolelist-list-li1"), $(this).find("li").eq(1).addClass("rolelist-list-li2")
                }), window.normallist = {};
                for (var c = 0; c < $(".match-show-vote").length; c++) normallist["s" + c] = [];
                s(t)
              });
              break;
            case 0:
            default:
              y = e.result.voteGroups[0].vote_num;
              for (var r = [], c = []; e.result.voteGroups[0].characters.length > 0;) {
                var v = Math.floor(Math.random() * e.result.voteGroups[0].characters.length);
                r.push(e.result.voteGroups[0].characters[v]), e.result.voteGroups[0].characters.splice(v, 1)
              }
              for (e.result.voteGroups[0].characters = r; e.result.voteGroups[1].characters.length > 0;) {
                var v = Math.floor(Math.random() * e.result.voteGroups[1].characters.length);
                c.push(e.result.voteGroups[1].characters[v]), e.result.voteGroups[1].characters.splice(v, 1)
              }
              e.result.voteGroups[1].characters = c, k = j, w = T, votepopuptpl = C, u(), $(".content").addClass("clearfix").append(k(e.result)), s(t)
          }
        }
      })
    }
    function s(e) {
      if ($.ajax({
          url: "/moe/2016/" + ajaxOpt.area + "/api/schedule/ticket/status",
          success: function(e) {
            return 0 != e.code ? void S.alert({
              content: e.message
            }) : void $(".vote-info-ticket").append(O({
              data: e.result,
              type: ajaxOpt.match_type
            }))
          }
        }), UserStatus.status().isLogin) $.ajax({
        url: "/moe/2016/" + ajaxOpt.area + "/api/vote/my_current_vote",
        success: function(t) {
          if (0 != t.code) return void S.alert({
            content: t.message
          });
          var a = new Date;
          if ($(".content").append(q({
              year: a.getFullYear(),
              month: J[a.getMonth()],
              day: a.getDate(),
              title: e,
              remain_count: t.result.remain_count
            })), Q = t.result, Q.voteNum = y, 2 != t.result.schedule_status ? ($(".vote-float-wrapper").append(w(Q)), U = {}) : ($(".vote").css({
              marginBottom: 0
            }), $(".vote-info-ticket").hide(), D = !0), 1 == t.result.has_ticket) {
            window.gotTicket = !0;
            var i = setInterval(function() {
              $(".vote-info-ticket-get").length > 0 && ($(".vote-info-ticket-get").html("今日资格已领").addClass("got"), clearInterval(i))
            }, 100)
          }
          if (1 == t.result.has_voted) if (D = !0, t.result.votes && t.result.votes.length > 0, t.result.votes && t.result.votes.length > 0) {
            var s = "";
            $.each(t.result.votes, function(e, t) {
              $.each(t.list, function(e, t) {
                s += t.character.chn_name + "、", $("[data-id=" + t.character.character_id + "]").removeClass("uncheck").addClass("checked").parents(".match-show-vote").find(".group-checkbox").attr("checked", !0)
              })
            }), s = s.substring(0, s.length - 1), U = {
              topic: "#Bilibili Moe 2016#",
              topic_title: "#Bilibili Moe 2016#",
              topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
              share_cover: ajaxOpt.share_cover,
              shareText: "今天我投给了" + s + "，你也来为喜爱的角色投票吧！"
            }
          } else if (t.result.tl_chara) {
            var s = t.result.tl_chara.chn_name;
            $("[data-id=" + t.result.tl_chara.character_id + "]").addClass("checked").parents(".match-show-vote").find(".group-checkbox").attr("checked", !0), U = {
              topic: "#Bilibili Moe 2016#",
              topic_title: "#Bilibili Moe 2016#",
              topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
              share_cover: ajaxOpt.share_cover,
              shareText: "今天我投给了" + s + "，你也来为喜爱的角色投票吧！"
            }
          } else U = {
            topic: "#Bilibili Moe 2016#",
            topic_title: "#Bilibili Moe 2016#",
            topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
            share_cover: ajaxOpt.share_cover,
            shareText: ajaxOpt.areaName + "动画场投票进行中，超过600名角色参与，来为你喜爱的角色投上关键的一票吧！"
          };
          else U = 2 == t.result.schedule_status ? {
            topic: "#Bilibili Moe 2016#",
            topic_title: "#Bilibili Moe 2016#",
            topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
            share_cover: ajaxOpt.share_cover,
            shareText: ajaxOpt.areaName + "动画场本日投票已结束，来看看今天的票选结果吧——"
          } : {
            topic: "#Bilibili Moe 2016#",
            topic_title: "#Bilibili Moe 2016#",
            topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
            share_cover: ajaxOpt.share_cover,
            shareText: ajaxOpt.areaName + "动画场投票进行中，超过600名角色参与，来为你喜爱的角色投上关键的一票吧！"
          };
          bindShare({
            url: U.topic_url,
            title: U.topic_title + U.shareText,
            desc: U.shareText,
            summary: U.shareText,
            shortTitle: U.topic_title,
            pic: U.share_cover,
            searchPic: U.share_cover
          }, ".vote-info-ticket-share .share-btn, .vote-normal-ticket-share .share-btn, .com-top-share .share-btn")
        }
      });
      else {
        $(".vote").css({
          marginBottom: 0
        }), D = !0, U = {
          topic: "#Bilibili Moe 2016#",
          topic_title: "#Bilibili Moe 2016#",
          topic_url: location.href
        };
        var t = setInterval(function() {
          ajaxOpt.startTime && (1 == ajaxOpt.schedule_status ? U.shareText = ajaxOpt.areaName + "动画场投票进行中，超过600名角色参与，来为你喜爱的角色投上关键的一票吧！" : 2 == ajaxOpt.schedule_status && (U.shareText = ajaxOpt.areaName + "动画场本日投票已结束，来看看今天的票选结果吧"), bindShare({
            url: U.topic_url,
            title: U.topic_title + U.shareText,
            desc: U.shareText,
            summary: U.shareText,
            shortTitle: U.topic_title,
            pic: U.share_cover,
            searchPic: U.share_cover
          }, ".share-btn"), clearInterval(t))
        }, 1e3)
      }
    }
    function l() {
      return UserStatus.status().isLogin ? void c(function() {
        $.ajax({
          url: "/moe/2016/" + ajaxOpt.area + "/api/vote/get_captcha",
          type: "POST",
          data: {
            token: window.csrf_token
          },
          success: function(e) {
            return 0 != e.code ? void S.alert({
              content: e.message
            }) : ($(".vote-normal-ticket-captcha-wrapper input").unbind("focus").focus(function(e) {
              $(this).unbind("keypress").keypress(function(e) {
                if ("13" == e.keyCode) {
                  if ($(".popup-wrapper").length > 0) return;
                  $(this).parents(".vote-normal-ticket-right").find(".get-normal-ticket-confrim").trigger("click")
                }
              })
            }), $(".vote-normal-ticket-captcha").attr("src", e.result.url), void(window.captcha_token = e.result.url.split("=")[2]))
          }
        })
      }) : void biliQuickLogin(function() {
        location.reload()
      })
    }
    function o(e) {
      return UserStatus.status().isLogin ? void c(function() {
        $.ajax({
          url: "/moe/2016/" + ajaxOpt.area + "/api/vote/acquire_qualification",
          type: "POST",
          data: {
            token: window.csrf_token,
            captcha_token: window.captcha_token,
            code: e,
            type: 0
          },
          success: function(e) {
            return 0 != e.code ? void S.alert({
              content: e.message
            }) : void S.alert({
              title: "领取成功",
              content: "成功领取今日投票资格<br>有效期：今晚23:00前",
              btnText: "知道了",
              callback: function() {
                location.reload()
              }
            })
          }
        })
      }, !0) : void biliQuickLogin(function() {
        location.reload()
      })
    }
    function r() {
      if (!$(".vote-btn.reallove").hasClass("voted")) return UserStatus.status().isLogin ? void c(function() {
        $.ajax({
          url: "/moe/2016/" + ajaxOpt.area + "/api/vote/acquire_qualification",
          type: "POST",
          data: {
            token: window.csrf_token,
            type: 1
          },
          success: function(e) {
            setTimeout(function() {
              return 0 != e.code ? void S.alert({
                content: e.message
              }) : ($(".vote-popupbox-wrapper").hide(), $(".get-reallove-ticket").show(), void $("body").on("click", function() {
                location.reload()
              }))
            }, 5e3)
          }
        })
      }, !0) : void biliQuickLogin(function() {
        location.reload()
      })
    }
    function c(e, t) {
      return window.csrf_token && !t ? void(e && e()) : void $.ajax({
        url: "/web_api/get_token",
        async: !1,
        success: function(t) {
          window.csrf_token = t.result.token, e && e()
        }
      })
    }
    function v(e, t) {
      S.confirm({
        title: "确定选择",
        content: "确定吗？投票后不可更改哦~",
        cancelText: "再想想",
        confirm: function() {
          c(function() {
            $.ajax({
              url: "/moe/2016/" + ajaxOpt.area + "/api/vote/vote?token=" + window.csrf_token,
              type: "POST",
              contentType: "application/json",
              dataType: "json",
              data: JSON.stringify({
                votes: e
              }),
              success: function(e) {
                return 0 != e.code ? void S.alert({
                  content: e.message
                }) : (t && t(e), rec_rp("event", "moe_votesuccess_web"), void $("body").on("click", function() {
                  location.reload()
                }))
              }
            })
          }, !0)
        }
      })
    }
    function n(e) {
      if (e.stopPropagation(), !$(".vote-btn.reallove").hasClass("voted")) {
        var t = [];
        reallove.type = 1, t.push({
          group_id: reallove.group_id,
          list: [reallove]
        }), v(t, function(e) {
          $(".content").append(votepopuptpl()), $(".vote-reallove-ticket").parent().show(), $(".vote-reallove-ticket").show(), U = {
            topic: "#Bilibili Moe 2016#",
            topic_title: "#Bilibili Moe 2016#",
            topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
            share_cover: reallove.cover,
            shareText: "我为我的真爱——" + reallove.chn_name + "投出了最宝贵的【真爱票】，今天将能获得我的双份票数加成！"
          }, bindShare({
            url: U.topic_url,
            title: U.topic_title + U.shareText,
            desc: U.shareText,
            summary: U.shareText,
            shortTitle: U.topic_title,
            pic: U.share_cover,
            searchPic: U.share_cover
          }, ".vote-voted-share-btns .share-btn")
        })
      }
    }
    function d(e) {
      if (!$(".vote-btn.normal").hasClass("voted")) {
        e.stopPropagation();
        var t = [];
        normallist.s0.length > 0 && t.push({
          group_id: normallist.s0[0].group_id,
          list: normallist.s0
        }), normallist.s1.length > 0 && t.push({
          group_id: normallist.s1[0].group_id,
          list: normallist.s1
        }), v(t, function(e) {
          $(".content").append(votepopuptpl()), $(".vote-normal-ticket").parent().show(), $(".vote-normal-ticket").show();
          var t = "";
          normallist.s0.length > 0 && $.each(normallist.s0, function(e, a) {
            t += a.chn_name + "、"
          }), normallist.s1.length > 0 && $.each(normallist.s1, function(e, a) {
            t += a.chn_name + "、"
          }), t = t.substring(0, t.length - 1), U = {
            topic: "#Bilibili Moe 2016#",
            topic_title: "#Bilibili Moe 2016#",
            topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
            share_cover: ajaxOpt.share_cover,
            shareText: "今天我投给了" + t + "，你也来为喜爱的角色投票吧！"
          }, bindShare({
            url: U.topic_url,
            title: U.topic_title + U.shareText,
            desc: U.shareText,
            summary: U.shareText,
            shortTitle: U.topic_title,
            pic: U.share_cover,
            searchPic: U.share_cover
          }, ".vote-voted-share-btns .share-btn")
        })
      }
    }
    function u() {
      $("body").on("click", ".vote-change-reallove", function() {
        $(this).hasClass("not-allow") || (state = "reallove", $("li").removeClass("checked"), h(), $(".vote-select-normal").hide(), $(".vote-select-reallove").show())
      }), $("body").on("click", ".vote-change-normal", function() {
        state = "normal", $("li").removeClass("checked"), h(), $(".vote-select-normal").show(), $(".vote-select-reallove").hide()
      }), $("body").on("click", ".vote-btn.normal", d), $("body").on("click", ".vote-btn.reallove", n), $("body").on("click", ".rolelist-list li", function() {
        return UserStatus.status().isLogin ? window.gotTicket ? void(D || 1 == $(this).css("opacity") && ($(this).toggleClass("checked"), h())) : void S.alert({
          content: "请先领票~"
        }) : void biliQuickLogin(function() {
          location.reload()
        })
      }), $("body").on("click", ".vote-select-list li", function() {
        $("[data-id=" + $(this).data("id") + "]").removeClass("checked"), h()
      }), $("body").on("click", ".vote-info-ticket-get", function(e) {
        e.stopPropagation(), $(this).hasClass("got") || (l(), $(".get-normal-ticket").show())
      }), $("body").on("click", ".vote-normal-ticket-captcha", l), $("body").on("click", ".vote-info-ticket-share .share-btn", r), $("body").on("click", ".close", function() {
        $(".vote-popupbox-wrapper").hide()
      }), $("body").on("click", ".get-normal-ticket-confrim", function(e) {
        var t = $.trim($("input[name=code]").val());
        return "" == t ? void S.alert({
          content: "请输入验证码~"
        }) : void o(t)
      }), $("body").on("click", ".vote-popupbox", function(e) {
        e.stopPropagation()
      }), $("body").on("click", ".vote-popupbox-wrapper, .get-normal-ticket-close", function() {
        $(".vote-popupbox-wrapper").hide()
      }), $("body").on("click", ".vote-voted-btn-result", function() {
        window.open("http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/schedule/"), location.reload()
      }), $("body").on("click", ".vote-voted-btn-home", function() {
        window.open("http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/index"), location.reload()
      })
    }
    function h() {
      window.normallist = {
        s0: [],
        s1: []
      }, window.reallove = {}, "reallove" == state ? (reallove = {
        character_id: $(".checked").data("id"),
        cover: $(".checked").data("cover"),
        group_id: $(".checked").data("group"),
        season: $(".checked").data("season"),
        chn_name: $(".checked").data("name"),
        sex: $(".checked").data("sex"),
        type: 1
      }, $(".checked").length > 0 ? ($("li").css({
        opacity: .3
      }), $(".checked").css({
        opacity: 1
      })) : $("li").css({
        opacity: 1
      }), $(".vote-float-wrapper").html(w(Q)), $(".vote-select-normal").hide(), $(".vote-select-reallove").show(), bindShare({
        url: U.topic_url,
        title: U.topic_title + U.shareText,
        desc: U.shareText,
        summary: U.shareText,
        shortTitle: U.topic_title,
        pic: U.share_cover,
        searchPic: U.share_cover
      }, ".share-btn-wrapper .share-btn")) : ($.each($(".checked"), function(e, t) {
        1 == $(t).data("sex") ? normallist.s1.push({
          character_id: $(t).data("id"),
          cover: $(t).data("cover"),
          group_id: $(t).data("group"),
          chn_name: $(t).data("name"),
          season: $(t).data("season"),
          sex: $(".checked").data("sex"),
          type: 0
        }) : normallist.s0.push({
          character_id: $(t).data("id"),
          cover: $(t).data("cover"),
          group_id: $(t).data("group"),
          chn_name: $(t).data("name"),
          season: $(t).data("season"),
          sex: $(".checked").data("sex"),
          type: 0
        })
      }), normallist.s1.length === y ? ($(".rolelist-female li").css({
        opacity: .3
      }), $(".rolelist-female .checked").css({
        opacity: 1
      })) : $(".rolelist-female li").css({
        opacity: 1
      }), normallist.s0.length === y ? ($(".rolelist-male li").css({
        opacity: .3
      }), $(".rolelist-male .checked").css({
        opacity: 1
      })) : $(".rolelist-male li").css({
        opacity: 1
      }), $(".vote-float-wrapper").html(w(Q)), $(".vote-select-normal").show(), $(".vote-select-reallove").hide())
    }
    function p() {
      $("body").on("click", ".vote-change-reallove", function() {
        $(this).hasClass("not-allow") || (state = "reallove", $("li").removeClass("checked"), m(), $(".vote-select-normal").hide(), $(".vote-select-reallove").show())
      }), $("body").on("click", ".vote-change-normal", function() {
        state = "normal", $("li").removeClass("checked"), m(), $(".vote-select-normal").show(), $(".vote-select-reallove").hide()
      }), $("body").on("click", ".vote-btn.normal", f), $("body").on("click", ".vote-btn.reallove", n), $("body").on("click", ".rolelist-list li", function() {
        return UserStatus.status().isLogin ? window.gotTicket ? void(D || 1 == $(this).css("opacity") && ($(this).toggleClass("checked"), m())) : void S.alert({
          content: "请先领票~"
        }) : void biliQuickLogin(function() {
          location.reload()
        })
      }), $("body").on("click", ".vote-select-list li", function() {
        D || ($("[data-id=" + $(this).data("id") + "]").removeClass("checked"), m())
      }), $("body").on("click", ".vote-info-ticket-get", function(e) {
        e.stopPropagation(), $(this).hasClass("got") || (l(), $(".get-normal-ticket").show())
      }), $("body").on("click", ".vote-normal-ticket-captcha", l), $("body").on("click", ".vote-info-ticket-share .share-btn", r), $("body").on("click", ".close", function() {
        $(".vote-popupbox-wrapper").hide()
      }), $("body").on("click", ".get-normal-ticket-confrim", function(e) {
        var t = $.trim($("input[name=code]").val());
        return "" == t ? void S.alert({
          content: "请输入验证码~"
        }) : void o(t)
      }), $("body").on("click", ".vote-popupbox", function(e) {
        e.stopPropagation()
      }), $("body").on("click", ".vote-popupbox-wrapper, .get-normal-ticket-close", function() {
        $(".vote-popupbox-wrapper").hide()
      }), $("body").on("click", ".vote-voted-btn-result", function() {
        window.open("http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/schedule/"), location.reload()
      }), $("body").on("click", ".vote-voted-btn-home", function() {
        window.open("http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/index"), location.reload()
      })
    }
    function m() {
      window.normallist = {};
      for (var e = 0; e < $(".match-show-vote").length; e++) normallist["s" + e] = [];
      window.reallove = {}, "reallove" == state ? (reallove = {
        character_id: $(".checked").data("id"),
        cover: $(".checked").data("cover"),
        group_id: $(".checked").data("group"),
        season: $(".checked").data("season"),
        chn_name: $(".checked").data("name"),
        sex: $(".checked").data("sex"),
        type: 1
      }, $(".checked").length > 0 ? ($("li").css({
        opacity: .3
      }), $(".checked").css({
        opacity: 1
      })) : $("li").css({
        opacity: 1
      }), $(".vote-float-wrapper").html(w(Q)), $(".vote-select-normal").hide(), $(".vote-select-reallove").show(), bindShare({
        url: U.topic_url,
        title: U.topic_title + U.shareText,
        desc: U.shareText,
        summary: U.shareText,
        shortTitle: U.topic_title,
        pic: U.share_cover,
        searchPic: U.share_cover
      }, ".share-btn-wrapper .share-btn")) : ($.each($(".checked"), function(e, t) {
        var a = $(t).parents(".match-show-vote").index(".match-show-vote");
        normallist["s" + a].push({
          character_id: $(t).data("id"),
          cover: $(t).data("cover"),
          group_id: $(t).data("group"),
          chn_name: $(t).data("name"),
          season: $(t).data("season"),
          sex: $(t).data("sex"),
          type: 0
        })
      }), $.each($(".match-show-vote"), function(e, t) {
        normallist["s" + e].length === y[e] ? ($(t).find(".group-checkbox").attr("checked", !0), $(t).find("li").css({
          opacity: .3
        }), $(t).find(".checked").css({
          opacity: 1
        })) : ($(t).find(".group-checkbox").attr("checked", !1), $(t).find("li").css({
          opacity: 1
        }))
      }), $(".vote-float-wrapper").html(w(Q)), $.each($(".vote-select-list"), function(e, t) {
        $(t).find("img").length > 0 ? $(t).find(".vote-select-list-title").addClass("float-checked") : $(t).find(".vote-select-list-title").removeClass("float-checked")
      }), $(".vote-select-normal").show(), $(".vote-select-reallove").hide())
    }
    function f(e) {
      if (!$(".vote-btn.normal").hasClass("voted")) {
        e.stopPropagation();
        var t = [];
        for (var a in normallist) normallist[a].length > 0 && t.push({
          group_id: normallist[a][0].group_id,
          list: normallist[a]
        });
        v(t, function(e) {
          $(".content").append(votepopuptpl()), $(".vote-normal-ticket").parent().show(), $(".vote-normal-ticket").show();
          var t = "";
          for (var a in normallist) normallist[a].length > 0 && $.each(normallist[a], function(e, a) {
            t += a.chn_name + "、"
          });
          t = t.substring(0, t.length - 1), U = {
            topic: "#Bilibili Moe 2016#",
            topic_title: "#Bilibili Moe 2016#",
            topic_url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote.html",
            share_cover: ajaxOpt.share_cover,
            shareText: "今天我投给了" + t + "，你也来为喜爱的角色投票吧！"
          }, bindShare({
            url: U.topic_url,
            title: U.topic_title + U.shareText,
            desc: U.shareText,
            summary: U.shareText,
            shortTitle: U.topic_title,
            pic: U.share_cover,
            searchPic: U.share_cover
          }, ".vote-voted-share-btns .share-btn")
        })
      }
    }
    function g() {
      $("body").on("click", ".vote-change-reallove", function() {
        $(this).hasClass("not-allow") || (state = "reallove", $("li").removeClass("checked uncheck"), b(), $(".vote-select-normal").hide(), $(".vote-select-reallove").show())
      }), $("body").on("click", ".vote-change-normal", function() {
        state = "normal", $("li").removeClass("checked uncheck"), b(), $(".vote-select-normal").show(), $(".vote-select-reallove").hide()
      }), $("body").on("click", ".vote-btn.normal", f), $("body").on("click", ".vote-btn.reallove", n), $("body").on("click", ".rolelist-list li", function() {
        return UserStatus.status().isLogin ? window.gotTicket ? void(D || ("reallove" == state ? 1 != $(this).css("opacity") ? ($(".rolelist-list li").removeClass("checked").addClass("uncheck"), $(this).removeClass("uncheck").addClass("checked"), "2" == ajaxOpt.area && x($(this)), b()) : ($(this).toggleClass("checked"), "2" == ajaxOpt.area && x($(this)), b()) : 1 != $(this).css("opacity") ? ($(this).removeClass("uncheck").addClass("checked").siblings("li").removeClass("checked").addClass("uncheck"), "2" == ajaxOpt.area && x($(this)), b()) : ($(this).toggleClass("checked"), "2" == ajaxOpt.area && x($(this)), b()))) : void S.alert({
          content: "请先领票~"
        }) : void biliQuickLogin(function() {
          location.reload()
        })
      }), $("body").on("click", ".vote-select-list li", function() {
        D || ($("[data-id=" + $(this).data("id") + "]").removeClass("checked"), b())
      }), $("body").on("click", ".vote-info-ticket-get", function(e) {
        e.stopPropagation(), $(this).hasClass("got") || (l(), $(".get-normal-ticket").show())
      }), $("body").on("click", ".vote-normal-ticket-captcha", l), $("body").on("click", ".vote-info-ticket-share .share-btn", r), $("body").on("click", ".close", function() {
        $(".vote-popupbox-wrapper").hide()
      }), $("body").on("click", ".get-normal-ticket-confrim", function(e) {
        var t = $.trim($("input[name=code]").val());
        return "" == t ? void S.alert({
          content: "请输入验证码~"
        }) : void o(t)
      }), $("body").on("click", ".vote-popupbox", function(e) {
        e.stopPropagation()
      }), $("body").on("click", ".vote-popupbox-wrapper, .get-normal-ticket-close", function() {
        $(".vote-popupbox-wrapper").hide()
      }), $("body").on("click", ".vote-voted-btn-result", function() {
        window.open("http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/schedule/"), location.reload()
      }), $("body").on("click", ".vote-voted-btn-home", function() {
        window.open("http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/index"), location.reload()
      })
    }
    function b() {
      window.normallist = {};
      for (var e = 0; e < $(".match-show-vote").length; e++) normallist["s" + e] = [];
      window.reallove = {}, "reallove" == state ? (reallove = {
        character_id: $(".checked").data("id"),
        cover: $(".checked").data("cover"),
        group_id: $(".checked").data("group"),
        season: $(".checked").data("season"),
        chn_name: $(".checked").data("name"),
        sex: $(".checked").data("sex"),
        type: 1
      }, $(".checked").length > 0 ? ($("li:not(.checked)").addClass("uncheck").css({
        opacity: .3
      }), $(".checked").css({
        opacity: 1
      })) : $("li:not(.checked)").css({
        opacity: 1
      }), $(".vote-float-wrapper").html(w(Q)), $(".vote-select-normal").hide(), $(".vote-select-reallove").show(), bindShare({
        url: U.topic_url,
        title: U.topic_title + U.shareText,
        desc: U.shareText,
        summary: U.shareText,
        shortTitle: U.topic_title,
        pic: U.share_cover,
        searchPic: U.share_cover
      }, ".share-btn-wrapper .share-btn")) : ($.each($(".checked"), function(e, t) {
        var a = $(t).parents(".match-show-vote").index(".match-show-vote");
        normallist["s" + a].push({
          character_id: $(t).data("id"),
          cover: $(t).data("cover"),
          group_id: $(t).data("group"),
          chn_name: $(t).data("name"),
          season: $(t).data("season"),
          sex: $(t).data("sex"),
          type: 0
        })
      }), $.each($(".match-show-vote"), function(e, t) {
        normallist["s" + e].length === y[e] ? ($(t).find(".group-checkbox").attr("checked", !0), $(t).find("li:not(.checked)").addClass("uncheck").css({
          opacity: .3
        }), $(t).find(".checked").css({
          opacity: 1
        })) : ($(t).find(".group-checkbox").attr("checked", !1), $(t).find("li:not(.checked)").removeClass("uncheck").css({
          opacity: 1
        }))
      }), $(".vote-float-wrapper").html(w(Q)), $.each($(".vote-select-list"), function(e, t) {
        $(t).find("img").length > 0 ? $(t).find(".vote-select-list-title").addClass("float-checked") : $(t).find(".vote-select-list-title").removeClass("float-checked")
      }), $(".vote-select-normal").show(), $(".vote-select-reallove").hide())
    }
    function x(e) {
      browser.version.trident || (e.hasClass("checked") ? ($(".rolelist-list-checkmask").css({
        transition: "none",
        "background-size": "0%",
        opacity: "0.6",
        "z-index": "101"
      }), $(".rolelist-list-checkmask").css({
        top: e.find(".rolelist-list-i").offset().top - 110,
        left: e.find(".rolelist-list-i").offset().left - 110
      }), setTimeout(function() {
        $(".rolelist-list-checkmask").css({
          transition: "all .3s linear",
          "background-size": "100%",
          opacity: "0"
        }), $(".rolelist-list-checkmask").css({
          "z-index": "99"
        })
      }, 10)) : $(".rolelist-list-checkmask").css({
        transition: "none",
        "background-size": "0%",
        opacity: "0.6",
        "z-index": "99"
      }))
    }
    function _(e, t) {
      var a;
      "72" == e && (a = ajaxOpt.staticId[1]), "71" == e && (a = ajaxOpt.staticId[0]), $.ajax({
        url: "http://bangumi.bilibili.com/jsonp/static/" + a + ".ver?ts=" + (new Date).getTime(),
        success: function(e) {
          0 == e.code && t && t(e.result)
        }
      })
    }
    a(1);
    var k, w, y, j = a(43),
      O = a(44),
      T = a(45),
      C = a(46),
      q = a(47),
      S = a(48),
      z = a(50),
      G = a(51),
      M = a(52),
      N = a(53),
      P = a(54),
      B = a(55),
      L = a(56),
      A = a(57),
      I = a(58),
      D = !1;
    window.gotTicket = !1, navigator.userAgent.indexOf("iPad") > 0 ? ShareModule.openShareWindow = function(e, t) {
      var a = [];
      for (var i in t) null != t[i] && a.push(i + "=" + encodeURIComponent(t[i]));
      var s = e + a.join("&");
      return setTimeout(function() {
        window.open(s, "", "width=760, height=640, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no")
      }, 1e3), !1
    } : $("body").addClass("notpad"), window.ajaxOpt = {
      areaStr: $(".com-logo").hasClass("jp") ? "jp" : "cn",
      area: $(".com-logo").hasClass("jp") ? 2 : 1,
      areaName: $(".com-logo").hasClass("jp") ? "日本" : "国产",
      staticId: [81, 82]
    }, onLoginInfoLoaded(function() {
      i()
    }), window.normallist = {
      s0: [],
      s1: []
    }, window.reallove = {};
    var U, J = {
      9: "Oct.",
      10: "Nov.",
      11: "Dec.",
      0: "Jan.",
      1: "Feb."
    };
    window.state = "normal";
    var Q
  }, function(e, t) {
    function a() {
      $.ajax({
        url: "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.area + "/api/schedule/current.json?ts=" + (new Date).getTime(),
        success: function(e) {
          if (0 == e.code) {
            switch (ajaxOpt.endTime = new Date(e.result.endTime), ajaxOpt.endTime.setTime(e.result.endTime + 60 * (ajaxOpt.endTime.getTimezoneOffset() + 480) * 1e3), ajaxOpt.startTime = new Date(e.result.startTime), ajaxOpt.startTime.setTime(e.result.startTime + 60 * (ajaxOpt.startTime.getTimezoneOffset() + 480) * 1e3), e.result.schedule_status ? ajaxOpt.schedule_status = e.result.schedule_status : "", e.result.schedule_status) {
              case -1:
              case 0:
              default:
                break;
              case 1:
                $(".com-header-vote").removeClass("novote").attr("href", "http://bangumi.bilibili.com/moe/2016/" + ajaxOpt.areaStr + "/vote");
                break;
              case 2:
                $(".com-header-vote").removeClass("novote").addClass("endvote")
            }
            ajaxOpt.loadTime > ajaxOpt.endTime && $(".com-header-vote").removeClass("novote").addClass("endvote")
          }
        }
      })
    }
    function i() {
      $.ajax({
        url: "/moe/2016/" + ajaxOpt.area + "/api/vote/my_current_vote",
        success: function(e) {
          0 != e.code ? ajaxOpt.hasVote = "0" : e.result.has_voted ? ajaxOpt.hasVote = e.result.has_voted.toString() : ajaxOpt.hasVote = "0"
        }
      })
    }
    Array.isArray || (Array.isArray = function(e) {
      return "[object Array]" === Object.prototype.toString.call(e)
    }), Array.prototype.map || (Array.prototype.map = function(e, t) {
      var a, i, s;
      if (null == this) throw new TypeError(" this is null or not defined");
      var l = Object(this),
        o = l.length >>> 0;
      if ("function" != typeof e) throw new TypeError(e + " is not a function");
      for (t && (a = t), i = new Array(o), s = 0; s < o;) {
        var r, c;
        s in l && (r = l[s], c = e.call(a, r, s, l), i[s] = c), s++
      }
      return i
    }), window.ajaxOpt = {
      areaStr: $(".com-logo").hasClass("jp") ? "jp" : "cn",
      area: $(".com-logo").hasClass("jp") ? 2 : 1,
      areaName: $(".com-logo").hasClass("jp") ? "日本" : "国产"
    }, 1 == ajaxOpt.area ? ajaxOpt.share_cover = "http://s1.hdslb.com/bfs/b/moe/images/share.png" : ajaxOpt.share_cover = "http://s1.hdslb.com/bfs/b/moe/images/jp/share_jp.png", $(window).ready(function() {
      $.ajax({
        url: "http://bangumi.bilibili.com/moe/2016/now?ts=" + (new Date).getTime(),
        success: function(e) {
          ajaxOpt.loadTime = e;
          var t = ajaxOpt.loadTime,
            a = new Date("2016/11/04 23:54:00").getTime();
          if ($("#load_comment").trigger("click"), t > a) {
            var i = $(".com-logo").hasClass("jp") ? "cn" : "jp";
            $(".com-banner").prepend('<div class="change-court"><a href="http://bangumi.bilibili.com/moe/2016/' + i + '/index"></a></div>')
          }
        }
      }), $(window).width() > 1440 ? $("body").addClass("widescreen") : $("body").removeClass("widescreen"), a(), i()
    }), $(window).resize(function(e) {
      $(window).width() > 1440 ? $("body").addClass("widescreen") : $("body").removeClass("widescreen")
    });
    ({
      version: function() {
        var e = navigator.userAgent;
        navigator.appVersion;
        return {
          trident: /Trident/i.test(e),
          presto: /Presto/i.test(e),
          webKit: /AppleWebKit/i.test(e),
          gecko: /Gecko/i.test(e) && !/KHTML/i.test(e),
          mobile: /AppleWebKit.*Mobile.*/i.test(e),
          ios: /\(i[^;]+;( U;)? CPU.+Mac OS X/i.test(e),
          android: /Android/i.test(e) || /Linux/i.test(e),
          windowsphone: /Windows Phone/i.test(e),
          iPhone: /iPhone/i.test(e),
          iPad: /iPad/i.test(e),
          MicroMessenger: /MicroMessenger/i.test(e),
          webApp: !/Safari/i.test(e),
          edge: /edge/i.test(e)
        }
      }(),
      language: (navigator.browserLanguage || navigator.language).toLowerCase()
    });
    window.bfsImage = function(e, t, a) {
      if (!e) return e;
      var i = /i[0-2]/;
      if (i.test(e)) {
        var s, l = "";
        if (e.indexOf("?") >= 0 && (s = e.split("?"), e = s[0], l = "?" + s[1]), e.indexOf("/bfs/") >= 0 || e.indexOf("/group1/") >= 0) {
          var i = /_+[0-9]+x[0-9]/;
          if (i.test(e)) return e;
          var o = e.split("."),
            r = o[o.length - 1];
          e += "_" + t + "x" + a + "." + r
        } else {
          var i = /\d+_\d+\//;
          i.test(e) && (e = e.replace(i, "")), e = e.replace("com/", "com/" + t + "_" + a + "/")
        }
        e += l
      }
      return e
    }
  }, , , , function(e, t, a) {
    "use strict";

    function i(e) {
      return null != e && "" !== e
    }
    function s(e) {
      return (Array.isArray(e) ? e.map(s) : e && "object" == typeof e ? Object.keys(e).filter(function(t) {
        return e[t]
      }) : [e]).filter(i).join(" ")
    }
    function l(e) {
      return r[e] || e
    }
    function o(e) {
      var t = String(e).replace(c, l);
      return t === "" + e ? e : t
    }
    t.merge = function v(e, t) {
      if (1 === arguments.length) {
        for (var a = e[0], s = 1; s < e.length; s++) a = v(a, e[s]);
        return a
      }
      var l = e["class"],
        o = t["class"];
      (l || o) && (l = l || [], o = o || [], Array.isArray(l) || (l = [l]), Array.isArray(o) || (o = [o]), e["class"] = l.concat(o).filter(i));
      for (var r in t)"class" != r && (e[r] = t[r]);
      return e
    }, t.joinClasses = s, t.cls = function(e, a) {
      for (var i = [], l = 0; l < e.length; l++) a && a[l] ? i.push(t.escape(s([e[l]]))) : i.push(s(e[l]));
      var o = s(i);
      return o.length ? ' class="' + o + '"' : ""
    }, t.style = function(e) {
      return e && "object" == typeof e ? Object.keys(e).map(function(t) {
        return t + ":" + e[t]
      }).join(";") : e
    }, t.attr = function(e, a, i, s) {
      return "style" === e && (a = t.style(a)), "boolean" == typeof a || null == a ? a ? " " + (s ? e : e + '="' + e + '"') : "" : 0 == e.indexOf("data") && "string" != typeof a ? (JSON.stringify(a).indexOf("&") !== -1 && console.warn("Since Jade 2.0.0, ampersands (`&`) in data attributes will be escaped to `&amp;`"), a && "function" == typeof a.toISOString && console.warn("Jade will eliminate the double quotes around dates in ISO form after 2.0.0"), " " + e + "='" + JSON.stringify(a).replace(/'/g, "&apos;") + "'") : i ? (a && "function" == typeof a.toISOString && console.warn("Jade will stringify dates in ISO form after 2.0.0"), " " + e + '="' + t.escape(a) + '"') : (a && "function" == typeof a.toISOString && console.warn("Jade will stringify dates in ISO form after 2.0.0"), " " + e + '="' + a + '"')
    }, t.attrs = function(e, a) {
      var i = [],
        l = Object.keys(e);
      if (l.length) for (var o = 0; o < l.length; ++o) {
        var r = l[o],
          c = e[r];
        "class" == r ? (c = s(c)) && i.push(" " + r + '="' + c + '"') : i.push(t.attr(r, c, !1, a))
      }
      return i.join("")
    };
    var r = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;"
      },
      c = /[&<>"]/g;
    t.escape = o, t.rethrow = function n(e, t, i, s) {
      if (!(e instanceof Error)) throw e;
      if (!("undefined" == typeof window && t || s)) throw e.message += " on line " + i, e;
      try {
        s = s || a(6).readFileSync(t, "utf8")
      } catch (l) {
        n(e, null, i)
      }
      var o = 3,
        r = s.split("\n"),
        c = Math.max(i - o, 0),
        v = Math.min(r.length, i + o),
        o = r.slice(c, v).map(function(e, t) {
          var a = t + c + 1;
          return (a == i ? "  > " : "    ") + a + "| " + e
        }).join("\n");
      throw e.path = t, e.message = (t || "Jade") + ":" + i + "\n" + o + "\n\n" + e.message, e
    }, t.DebugItem = function(e, t) {
      this.lineno = e, this.filename = t
    }
  }, function(e, t) {}, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l) {
        a.push('<div class="container-row vote-info-wrapper"><h1>' + i.escape(null == (t = e) ? "" : t) + '</h1><div class="vote-info-rule"><ul><li>关于真爱票：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、当天单投时可用</li><li>4、使用真爱票后该票计为两张</li></ul></div><div class="vote-info-ticket"></div></div>'), function() {
          var e = l;
          if ("number" == typeof e.length) for (var s = 0, o = e.length; s < o; s++) {
            var r = e[s];
            1 == r.sex && r.characters.length > 0 && (a.push('<div class="container-row rolelist-female female"><div class="rolelist-title"><i class="sex-icon i46"></i>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected female"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected female"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                }
              }
            }.call(this), a.push("</ul></div></div>")), 0 == r.sex && r.characters.length > 0 && (a.push('<div class="container-row rolelist-male male"><div class="rolelist-title"><i class="sex-icon i46"></i>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected male"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected male"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                }
              }
            }.call(this), a.push("</ul></div></div>"))
          } else {
            var o = 0;
            for (var s in e) {
              o++;
              var r = e[s];
              1 == r.sex && r.characters.length > 0 && (a.push('<div class="container-row rolelist-female female"><div class="rolelist-title"><i class="sex-icon i46"></i>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected female"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected female"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                  }
                }
              }.call(this), a.push("</ul></div></div>")), 0 == r.sex && r.characters.length > 0 && (a.push('<div class="container-row rolelist-male male"><div class="rolelist-title"><i class="sex-icon i46"></i>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected male"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected male"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                  }
                }
              }.call(this), a.push("</ul></div></div>"))
            }
          }
        }.call(this)
      }.call(this, "title" in s ? s.title : "undefined" != typeof title ? title : void 0, "undefined" in s ? s.undefined : void 0, "voteGroups" in s ? s.voteGroups : "undefined" != typeof voteGroups ? voteGroups : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s) {
        a.push('<div class="vote-info-ticket-surplus">本次剩余<p>' + i.escape(null == (t = e.surplus_num) ? "" : t) + '</p></div><div class="gap-line"></div><div class="vote-info-ticket-next">下次派票<p>' + i.escape(null == (t = e.next_time) ? "" : t) + '</p></div><div class="vote-info-ticket-get">领取投票资格</div>'), 4 != s && a.push('<div class="vote-info-ticket-share">分享获得真爱票：<div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div>')
      }.call(this, "data" in s ? s.data : "undefined" != typeof data ? data : void 0, "type" in s ? s.type : "undefined" != typeof type ? type : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r, c, v) {
        if (a.push('<div class="vote-float-top"></div><div class="container-row vote-select-normal"><div class="vote-select-list-wrapper">'), v) a.push('<div class="vote-select-list female"><div class="vote-select-list-title clearfix"><div class="vote-select-list-title-left"><i class="sex-icon i22"></i>已选女性角色</div></div><ul class="clearfix">'), function() {
          var e = 1 == v[0].sex ? v[0].list : v[1].list;
          if ("number" == typeof e.length) for (var t = 0, s = e.length; t < s; t++) {
            var l = e[t];
            a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
          } else {
            var s = 0;
            for (var t in e) {
              s++;
              var l = e[t];
              a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
            }
          }
        }.call(this), a.push('</ul></div><div class="vote-select-list male"><div class="vote-select-list-title clearfix"><div class="vote-select-list-title-left"><i class="sex-icon i22"></i>已选男性角色</div></div><ul class="clearfix">'), function() {
          var e = 0 == v[0].sex ? v[0].list : v[1].list;
          if ("number" == typeof e.length) for (var t = 0, s = e.length; t < s; t++) {
            var l = e[t];
            a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
          } else {
            var s = 0;
            for (var t in e) {
              s++;
              var l = e[t];
              a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
            }
          }
        }.call(this), a.push("</ul></div>");
        else {
          a.push('<div class="vote-select-list female"><div class="vote-select-list-title clearfix"><div class="vote-select-list-title-left"><i class="sex-icon i22"></i>已选女性角色</div><div class="vote-select-list-title-right">剩余可选：<span>' + i.escape(null == (t = c - s.s1.length) ? "" : t) + '</span></div></div><ul class="clearfix">');
          for (var n = 0; n < c;) s.s1[n] ? a.push("<li" + i.attr("data-id", "" + s.s1[n].character_id, !0, !0) + "><img" + i.attr("src", "" + s.s1[n].cover, !0, !0) + "></li>") : a.push("<li></li>"), n++;
          a.push('</ul></div><div class="vote-select-list male"><div class="vote-select-list-title clearfix"><div class="vote-select-list-title-left"><i class="sex-icon i22"></i>已选男性角色</div><div class="vote-select-list-title-right">剩余可选：<span>' + i.escape(null == (t = c - s.s0.length) ? "" : t) + '</span></div></div><ul class="clearfix">');
          for (var n = 0; n < c;) s.s0[n] ? a.push("<li" + i.attr("data-id", "" + s.s0[n].character_id, !0, !0) + "><img" + i.attr("src", "" + s.s0[n].cover, !0, !0) + "></li>") : a.push("<li></li>"), n++;
          a.push("</ul></div>")
        }
        a.push('</div><div class="vote-btn-wrapper"><div class="vote-btn-bg">'), v ? a.push('<div class="vote-btn normal voted"></div>') : a.push('<div class="vote-btn normal"></div>'), a.push('</div><div class="vote-change vote-change-reallove"></div></div></div>'), o ? a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg"><div class="vote-btn reallove voted"></div></div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '></div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status voted">当前真爱票状态：<span>已用</span></div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>') : (a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg">'), v ? a.push('<div class="vote-btn normal voted"></div>') : a.push('<div class="vote-btn reallove"></div>'), a.push('</div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img">'), l.cover ? a.push("<img" + i.attr("src", "" + l.cover, !0, !0) + ">") : a.push('<img src="">'), a.push('</div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status">当前真爱票状态：'), 1 == e ? a.push("<span>未用</span>") : a.push("<span>未领</span>"), a.push('</div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>'))
      }.call(this, "got_tl_ticket" in s ? s.got_tl_ticket : "undefined" != typeof got_tl_ticket ? got_tl_ticket : void 0, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "reallove" in s ? s.reallove : "undefined" != typeof reallove ? reallove : void 0, "tl_chara" in s ? s.tl_chara : "undefined" != typeof tl_chara ? tl_chara : void 0, "undefined" in s ? s.undefined : void 0, "voteNum" in s ? s.voteNum : "undefined" != typeof voteNum ? voteNum : void 0, "votes" in s ? s.votes : "undefined" != typeof votes ? votes : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l) {
        a.push('<div class="vote-popupbox-wrapper voted"><!-- 普通投票-->'), (e.s0.length > 0 || e.s1.length > 0) && (a.push('<div class="vote-popupbox vote-normal-ticket"><div class="vote-voted-title">您已成功参与今天的投票！</div><div class="vote-voted-content"><div class="vote-normal-ticket-list female"><div class="vote-normal-ticket-list-title"><i class="sex-icon i22"></i>已选女性角色</div><ul class="clearfix">'), function() {
          var s = e.s1;
          if ("number" == typeof s.length) for (var l = 0, o = s.length; l < o; l++) {
            var r = s[l];
            a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + r.cover, !0, !0) + '></div><div class="vote-normal-ticket-name">' + i.escape(null == (t = r.chn_name) ? "" : t) + " </div></li>")
          } else {
            var o = 0;
            for (var l in s) {
              o++;
              var r = s[l];
              a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + r.cover, !0, !0) + '></div><div class="vote-normal-ticket-name">' + i.escape(null == (t = r.chn_name) ? "" : t) + " </div></li>")
            }
          }
        }.call(this), a.push('</ul></div><div class="vote-normal-ticket-list male"><div class="vote-normal-ticket-list-title"><i class="sex-icon i22"></i>已选男性角色</div><ul class="clearfix">'), function() {
          var s = e.s0;
          if ("number" == typeof s.length) for (var l = 0, o = s.length; l < o; l++) {
            var r = s[l];
            a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + r.cover, !0, !0) + '></div><div class="vote-normal-ticket-name">' + i.escape(null == (t = r.chn_name) ? "" : t) + " </div></li>")
          } else {
            var o = 0;
            for (var l in s) {
              o++;
              var r = s[l];
              a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + r.cover, !0, !0) + '></div><div class="vote-normal-ticket-name">' + i.escape(null == (t = r.chn_name) ? "" : t) + " </div></li>")
            }
          }
        }.call(this), a.push('</ul></div><div class="vote-voted-share"><div class="vote-voted-shares-text">你对角色的爱已经成功传达出去！<br>叫上你的好基友一起来参与吧！</div><div class="vote-voted-share-btns"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div><div class="vote-voted-btns"><div class="vote-voted-btn-result"></div><div class="vote-voted-btn-home"></div></div></div>')), a.push("<!-- 真爱票-->"), s.cover && (a.push('<div class="vote-popupbox vote-reallove-ticket"><div class="vote-voted-title">您已成功参与今天的投票！</div><div class="vote-voted-content"><div class="vote-reallove-ticket-content"><div class="vote-reallove-ticket-title"><i></i>真爱票</div>'), 0 == s.sex ? a.push('<div class="vote-reallove-ticket-info male clearfix"><div class="vote-reallove-ticket-img"><img' + i.attr("src", "" + s.cover, !0, !0) + '></div><div class="vote-reallove-ticket-text"><div class="vote-reallove-ticket-sex"><i class="sex-icon i22"></i>男性角色</div><div class="vote-reallove-ticket-name">' + i.escape(null == (t = s.chn_name) ? "" : t) + '</div><div class="vote-reallove-ticket-anime">' + i.escape(null == (t = s.season) ? "" : t) + "</div></div></div>") : a.push('<div class="vote-reallove-ticket-info female clearfix"><div class="vote-reallove-ticket-img"><img' + i.attr("src", "" + s.cover, !0, !0) + '></div><div class="vote-reallove-ticket-text"><div class="vote-reallove-ticket-sex"><i class="sex-icon i22"></i>女性角色</div><div class="vote-reallove-ticket-name">' + i.escape(null == (t = s.chn_name) ? "" : t) + '</div><div class="vote-reallove-ticket-anime">' + i.escape(null == (t = s.season) ? "" : t) + "</div></div></div>"), a.push('</div><div class="vote-reallove-ticket-tips"><ul><li>注意：</li><li>1、您已使用真爱票，该票所选角色计为两票</li><li>2、您的真爱票资格已用完</li></ul></div><div class="vote-voted-share"><div class="vote-voted-shares-text">你对角色的爱已经成功传达出去！<br>叫上你的好基友一起来参与吧！</div><div class="vote-voted-share-btns"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div><div class="vote-voted-btns"><div class="vote-voted-btn-result"></div><div class="vote-voted-btn-home"></div></div></div>')), a.push("</div>")
      }.call(this, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "reallove" in s ? s.reallove : "undefined" != typeof reallove ? reallove : void 0, "undefined" in s ? s.undefined : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r) {
        a.push('<div class="vote-popupbox-wrapper get-reallove-ticket"><!-- 真爱票领取成功--><div class="vote-popupbox"><div class="get-reallove-ticket-close close">知道了</div></div></div><div class="vote-popupbox-wrapper get-normal-ticket"><!-- 不能领票-->'), o <= 0 ? (a.push('<div class="vote-popupbox no-ticket"><div class="vote-normal-ticket-left"><div class="vote-normal-ticket-date clearfix"><div class="date-month">' + i.escape(null == (t = s) ? "" : t) + "<p>" + i.escape(null == (t = l) ? "" : t) + " " + i.escape(null == (t = r) ? "" : t) + "</p></div>"), 0 == e.match_type && a.push('<div class="date-day color-audition">海选赛</div>'), 1 == e.match_type && a.push('<div class="date-day color-relive">复活赛</div>'), 2 == e.match_type && a.push('<div class="date-day color-knockout">本战</div>'), 3 == e.match_type && a.push('<div class="date-day color-final">决赛</div>'), 4 == e.match_type && a.push('<div class="date-day color-show">表演赛</div>'), a.push('<div class="vote-normal-ticket-share clearfix"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div><div class="vote-normal-ticket-tips">票已领完，请等待下一波放票~</div></div><div class="vote-normal-ticket-right"><div class="get-normal-ticket-btn get-normal-ticket-close">确定</div></div></div>')) : (a.push('<!-- 输入验证码领票--><div class="vote-popupbox"><div class="vote-normal-ticket-left"><div class="vote-normal-ticket-date clearfix"><div class="date-month">' + i.escape(null == (t = s) ? "" : t) + "<p>" + i.escape(null == (t = l) ? "" : t) + " " + i.escape(null == (t = r) ? "" : t) + "</p></div>"), 0 == e.match_type && a.push('<div class="date-day color-audition">海选赛</div>'), 1 == e.match_type && a.push('<div class="date-day color-relive">复活赛</div>'), 2 == e.match_type && a.push('<div class="date-day color-knockout">本战</div>'), 3 == e.match_type && a.push('<div class="date-day color-final">决赛</div>'), 4 == e.match_type && a.push('<div class="date-day color-show">表演赛</div>'), a.push('</div><div class="vote-normal-ticket-share clearfix"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div><div class="vote-normal-ticket-tips">领取投票资格需花费<span>1硬币</span>。<br>2016年10月1日之后注册的用户不能进行投票哦~</div></div><div class="vote-normal-ticket-right"><div class="vote-normal-ticket-captcha-wrapper"><label>请输入验证码：<input type="text" name="code" maxlength="4"></label><img src="" class="vote-normal-ticket-captcha"></div><div class="get-normal-ticket-btn get-normal-ticket-confrim">确定</div></div></div>')), a.push("</div>")
      }.call(this, "ajaxOpt" in s ? s.ajaxOpt : "undefined" != typeof ajaxOpt ? ajaxOpt : void 0, "day" in s ? s.day : "undefined" != typeof day ? day : void 0, "month" in s ? s.month : "undefined" != typeof month ? month : void 0, "remain_count" in s ? s.remain_count : "undefined" != typeof remain_count ? remain_count : void 0, "year" in s ? s.year : "undefined" != typeof year ? year : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = {},
      s = window.$,
      l = a(49),
      o = {
        title: "提示",
        btnText: "确定",
        cancelText: "取消",
        type: "alert"
      };
    i.alert = function(e) {
      var t = s(l({
        title: e.title || o.title,
        content: e.content,
        btnText: e.btnText || o.btnText
      }));
      s(".popup-btn", t).on("click", function(a) {
        e.callback && e.callback(), t.remove()
      }), s("body").append(t);
      var a = s(".popup-inner", t);
      a.css({
        marginLeft: -a.width() / 2,
        marginTop: -a.height() / 2
      })
    }, i.confirm = function(e) {
      var t = s(l({
        title: e.title || o.title,
        content: e.content,
        btnText: e.btnText || o.btnText,
        cancelText: e.cancelText || o.cancelText,
        type: "confirm"
      }));
      s(".popup-btn", t).on("click", function() {
        s(this).hasClass("cancel") || e.confirm && e.confirm(), e.callback && e.callback(), t.remove()
      }), s("body").append(t);
      var a = s(".popup-inner", t);
      a.css({
        marginLeft: -a.width() / 2,
        marginTop: -a.height() / 2
      })
    }, e.exports = i
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r) {
        a.push('<div class="popup-wrapper"><div class="popup-inner"><div class="popup-header">' + i.escape(null == (t = o) ? "" : t) + '</div><div class="popup-content">' + (null == (t = l) ? "" : t) + '</div><div class="popup-footer">'), "confirm" == r ? a.push('<div class="popup-btn cancel">' + i.escape(null == (t = s) ? "" : t) + '</div><div class="popup-btn">' + i.escape(null == (t = e) ? "" : t) + "</div>") : a.push('<div class="popup-btn">' + i.escape(null == (t = e) ? "" : t) + "</div>"), a.push("</div></div></div>")
      }.call(this, "btnText" in s ? s.btnText : "undefined" != typeof btnText ? btnText : void 0, "cancelText" in s ? s.cancelText : "undefined" != typeof cancelText ? cancelText : void 0, "content" in s ? s.content : "undefined" != typeof content ? content : void 0, "title" in s ? s.title : "undefined" != typeof title ? title : void 0, "type" in s ? s.type : "undefined" != typeof type ? type : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o) {
        a.push('<div class="container-row vote-info-wrapper"><h1>' + i.escape(null == (t = e) ? "" : t) + '</h1><div class="vote-info-rule">'), 4 == s ? a.push("<ul><li>关于表演赛：</li><li>1、表演赛每组只可选择一位角色</li><li>2、表演赛不可使用真爱票</li></ul>") : a.push("<ul><li>本战投票规则：</li><li>1、每组可选择1位进行投票，可不选</li><li>2、使用真爱票时只能选择1位真爱角色进行投票</li><li>3、每天只可进行一次投票，请珍惜投票机会</li></ul>"), a.push('</div><div class="vote-info-ticket"></div></div>'), 4 == s ? (a.push('<div class="container-row">'), function() {
          var e = o;
          if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
            var r = e[s];
            a.push('<div class="match-show-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                }
              }
            }.call(this), a.push("</ul></div></div>")
          } else {
            var l = 0;
            for (var s in e) {
              l++;
              var r = e[s];
              a.push('<div class="match-show-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                  }
                }
              }.call(this), a.push("</ul></div></div>")
            }
          }
        }.call(this), a.push("</div>")) : (a.push('<div class="container-row"><div class="match-show-vote-title female"><i class="sex-icon i30"></i>女性角色</div><div class="match-show-vote-wrapper clearfix">'), function() {
          var e = o;
          if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
            var r = e[s];
            1 == r.sex && (a.push('<div class="match-show-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                }
              }
            }.call(this), a.push("</ul></div></div>"))
          } else {
            var l = 0;
            for (var s in e) {
              l++;
              var r = e[s];
              1 == r.sex && (a.push('<div class="match-show-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                  }
                }
              }.call(this), a.push("</ul></div></div>"))
            }
          }
        }.call(this), a.push('</div><div class="match-show-vote-title male"><i class="sex-icon i30"></i>男性角色</div><div class="match-show-vote-wrapper clearfix">'), function() {
          var e = o;
          if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
            var r = e[s];
            0 == r.sex && (a.push('<div class="match-show-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                }
              }
            }.call(this), a.push("</ul></div></div>"))
          } else {
            var l = 0;
            for (var s in e) {
              l++;
              var r = e[s];
              0 == r.sex && (a.push('<div class="match-show-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.cover, !0, !0) + '><div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">' + i.escape(null == (t = o.title) ? "" : t) + "</div></li>")
                  }
                }
              }.call(this), a.push("</ul></div></div>"))
            }
          }
        }.call(this), a.push("</div></div>"))
      }.call(this, "title" in s ? s.title : "undefined" != typeof title ? title : void 0, "type" in s ? s.type : "undefined" != typeof type ? type : void 0, "undefined" in s ? s.undefined : void 0, "voteGroups" in s ? s.voteGroups : "undefined" != typeof voteGroups ? voteGroups : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r) {
        if (a.push('<div class="vote-float-top"></div><div class="container-row vote-select-normal match-show-float"><div class="vote-select-list-wrapper">'), r)(function() {
          var e = r;
          if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
            var o = e[s];
            a.push('<div class="vote-select-list">'), o.list.length > 0 ? (a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix">'), function() {
              var e = o.list;
              if ("number" == typeof e.length) for (var t = 0, s = e.length; t < s; t++) {
                var l = e[t];
                a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
              } else {
                var s = 0;
                for (var t in e) {
                  s++;
                  var l = e[t];
                  a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
                }
              }
            }.call(this), a.push("</ul>")) : a.push('<div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul>'), a.push("</div>")
          } else {
            var l = 0;
            for (var s in e) {
              l++;
              var o = e[s];
              a.push('<div class="vote-select-list">'), o.list.length > 0 ? (a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix">'), function() {
                var e = o.list;
                if ("number" == typeof e.length) for (var t = 0, s = e.length; t < s; t++) {
                  var l = e[t];
                  a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
                } else {
                  var s = 0;
                  for (var t in e) {
                    s++;
                    var l = e[t];
                    a.push("<li" + i.attr("data-id", "" + l.character.character_id, !0, !0) + "><img" + i.attr("src", "" + l.character.cover, !0, !0) + "></li>")
                  }
                }
              }.call(this), a.push("</ul>")) : a.push('<div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul>'), a.push("</div>")
            }
          }
        }).call(this);
        else for (var c = e(".match-show-vote").length, v = 0; v < c; v++) {
          a.push('<div class="vote-select-list"><div class="vote-select-list-title">组' + i.escape(null == (t = v + 1) ? "" : t) + '</div><ul class="clearfix">');
          for (var n = 0; n < o[v];) s["s" + v] && s["s" + v][n] ? a.push("<li" + i.attr("data-id", "" + s["s" + v][n].character_id, !0, !0) + "><img" + i.attr("src", "" + s["s" + v][n].cover, !0, !0) + "></li>") : a.push("<li></li>"), n++;
          a.push("</ul></div>")
        }
        a.push('</div><div class="vote-btn-wrapper"><div class="vote-btn-bg">'), r ? a.push('<div class="vote-btn normal voted"></div>') : a.push('<div class="vote-btn normal"></div>'), a.push('</div><div class="vote-change vote-change-reallove not-allow"></div></div></div>')
      }.call(this, "$" in s ? s.$ : "undefined" != typeof $ ? $ : void 0, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "undefined" in s ? s.undefined : void 0, "voteNum" in s ? s.voteNum : "undefined" != typeof voteNum ? voteNum : void 0, "votes" in s ? s.votes : "undefined" != typeof votes ? votes : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o) {
        if (a.push('<div class="vote-popupbox-wrapper voted">'), "normal" == l) {
          a.push('<!-- 普通投票--><div class="vote-popupbox vote-normal-ticket"><div class="vote-voted-title">您已成功参与今天的投票！</div><div class="vote-voted-content"><div class="vote-normal-ticket-list clearfix">');
          var r = 0;
          (function() {
            var s = e;
            if ("number" == typeof s.length) for (var l = 0, o = s.length; l < o; l++) {
              var c = s[l];
              c.length > 0 ? (a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title">组' + i.escape(null == (t = ++r) ? "" : t) + '</div><ul class="clearfix">'), function() {
                var e = c;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                  }
                }
              }.call(this), a.push("</ul></div>")) : a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title noselect">组' + i.escape(null == (t = ++r) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
            } else {
              var o = 0;
              for (var l in s) {
                o++;
                var c = s[l];
                c.length > 0 ? (a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title">组' + i.escape(null == (t = ++r) ? "" : t) + '</div><ul class="clearfix">'), function() {
                  var e = c;
                  if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                    var o = e[s];
                    a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                  } else {
                    var l = 0;
                    for (var s in e) {
                      l++;
                      var o = e[s];
                      a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                    }
                  }
                }.call(this), a.push("</ul></div>")) : a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title noselect">组' + i.escape(null == (t = ++r) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
              }
            }
          }).call(this), a.push('</div><div class="vote-voted-share"><div class="vote-voted-shares-text">你对角色的爱已经成功传达出去！<br>叫上你的好基友一起来参与吧！</div><div class="vote-voted-share-btns"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div><div class="vote-voted-btns"><div class="vote-voted-btn-result"></div><div class="vote-voted-btn-home"></div></div></div>')
        }
        "reallove" == l && s.cover && (a.push('<div class="vote-popupbox vote-reallove-ticket"><div class="vote-voted-title">您已成功参与今天的投票！</div><div class="vote-voted-content"><div class="vote-reallove-ticket-content"><div class="vote-reallove-ticket-title"><i></i>真爱票</div>'), 0 == s.sex ? a.push('<div class="vote-reallove-ticket-info male clearfix"><div class="vote-reallove-ticket-img"><img' + i.attr("src", "" + s.cover, !0, !0) + '></div><div class="vote-reallove-ticket-text"><div class="vote-reallove-ticket-sex"><i class="sex-icon i22"></i>男性角色</div><div class="vote-reallove-ticket-name">' + i.escape(null == (t = s.chn_name) ? "" : t) + '</div><div class="vote-reallove-ticket-anime">' + i.escape(null == (t = s.season) ? "" : t) + "</div></div></div>") : a.push('<div class="vote-reallove-ticket-info female clearfix"><div class="vote-reallove-ticket-img"><img' + i.attr("src", "" + s.cover, !0, !0) + '></div><div class="vote-reallove-ticket-text"><div class="vote-reallove-ticket-sex"><i class="sex-icon i22"></i>女性角色</div><div class="vote-reallove-ticket-name">' + i.escape(null == (t = s.chn_name) ? "" : t) + '</div><div class="vote-reallove-ticket-anime">' + i.escape(null == (t = s.season) ? "" : t) + "</div></div></div>"), a.push('</div><div class="vote-reallove-ticket-tips"><ul><li>注意：</li><li>1、您已使用真爱票，该票所选角色计为两票</li><li>2、您的真爱票资格已用完</li></ul></div><div class="vote-voted-share"><div class="vote-voted-shares-text">你对角色的爱已经成功传达出去！<br>叫上你的好基友一起来参与吧！</div><div class="vote-voted-share-btns"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div><div class="vote-voted-btns"><div class="vote-voted-btn-result"></div><div class="vote-voted-btn-home"></div></div></div>')), a.push("</div>")
      }.call(this, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "reallove" in s ? s.reallove : "undefined" != typeof reallove ? reallove : void 0, "state" in s ? s.state : "undefined" != typeof state ? state : void 0, "undefined" in s ? s.undefined : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r, c, v, n) {
        if (a.push('<div class="vote-float-top"></div><div class="container-row vote-select-normal match-show-float"><div class="vote-select-list-wrapper">'), n)(function() {
          var e = n;
          if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
            var o = e[s];
            o.list.length > 0 ?
              function() {
                var e = o.list;
                if ("number" == typeof e.length) for (var l = 0, r = e.length; l < r; l++) {
                  var c = e[l];
                  1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                } else {
                  var r = 0;
                  for (var l in e) {
                    r++;
                    var c = e[l];
                    1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                  }
                }
              }.call(this) : a.push('<div class="vote-select-list"><div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
          } else {
            var l = 0;
            for (var s in e) {
              l++;
              var o = e[s];
              o.list.length > 0 ?
                function() {
                  var e = o.list;
                  if ("number" == typeof e.length) for (var l = 0, r = e.length; l < r; l++) {
                    var c = e[l];
                    1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                  } else {
                    var r = 0;
                    for (var l in e) {
                      r++;
                      var c = e[l];
                      1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                    }
                  }
                }.call(this) : a.push('<div class="vote-select-list"><div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
            }
          }
        }).call(this);
        else for (var d = e(".match-show-vote").length, u = 0; u < d; u++) for (var h = 0; h < v[u];) l["s" + u].length > 0 && 0 == l["s" + u][0].sex && a.push('<div class="vote-select-list vote-select-list-male">'), l["s" + u].length > 0 && 1 == l["s" + u][0].sex && a.push('<div class="vote-select-list vote-select-list-female">'), a.push('<div class="vote-select-list-title">组' + i.escape(null == (t = u + 1) ? "" : t) + '</div><ul class="clearfix">'), l["s" + u] && l["s" + u][h] ? a.push("<li" + i.attr("data-id", "" + l["s" + u][h].character_id, !0, !0) + "><img" + i.attr("src", "" + l["s" + u][h].cover, !0, !0) + "></li>") : a.push("<li></li>"), a.push("</ul></div>"), h++;
        a.push('</div><div class="vote-btn-wrapper"><div class="vote-btn-bg">'), n ? a.push('<div class="vote-btn normal voted"></div>') : a.push('<div class="vote-btn normal"></div>'), a.push('</div><div class="vote-change vote-change-reallove"></div></div></div>'), r ? a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg"><div class="vote-btn reallove voted"></div></div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img"><img' + i.attr("src", "" + r.cover, !0, !0) + '></div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status voted">当前真爱票状态：<span>已用</span></div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>') : (a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg"><div class="vote-btn reallove"></div></div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img">'), o.cover ? a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">") : a.push('<img src="">'), a.push('</div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status">当前真爱票状态：'), 1 == s ? a.push("<span>未用</span>") : a.push("<span>未领</span>"), a.push('</div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>'))
      }.call(this, "$" in s ? s.$ : "undefined" != typeof $ ? $ : void 0, "got_tl_ticket" in s ? s.got_tl_ticket : "undefined" != typeof got_tl_ticket ? got_tl_ticket : void 0, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "reallove" in s ? s.reallove : "undefined" != typeof reallove ? reallove : void 0, "tl_chara" in s ? s.tl_chara : "undefined" != typeof tl_chara ? tl_chara : void 0, "undefined" in s ? s.undefined : void 0, "voteNum" in s ? s.voteNum : "undefined" != typeof voteNum ? voteNum : void 0, "votes" in s ? s.votes : "undefined" != typeof votes ? votes : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l) {
        a.push('<div class="container-row vote-info-wrapper"><h1>' + i.escape(null == (t = e) ? "" : t) + '</h1><div class="vote-info-rule"><ul><li>决赛投票规则：</li><li>1、每组可选择1位进行投票，可不选</li><li>2、使用真爱票时只能选择1位真爱角色进行投票</li><li>3、每天只可进行一次投票，请珍惜投票机会</li></ul></div><div class="vote-info-ticket"></div></div><div class="container-row"><div class="match-show-vote-title female"><i class="sex-icon i30"></i>女性角色</div><div class="match-show-vote-wrapper clearfix female">'), function() {
          var e = l;
          if ("number" == typeof e.length) for (var s = 0, o = e.length; s < o; s++) {
            var r = e[s];
            1 == r.sex && (a.push('<!--基础模板套用表演赛,此处加final,做样式区别--><div class="match-show-vote match-final-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix rolelist-list-final">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧 : ' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介 : ' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧 : ' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介 : ' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
                }
              }
            }.call(this), a.push("</ul></div></div>"))
          } else {
            var o = 0;
            for (var s in e) {
              o++;
              var r = e[s];
              1 == r.sex && (a.push('<!--基础模板套用表演赛,此处加final,做样式区别--><div class="match-show-vote match-final-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix rolelist-list-final">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧 : ' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介 : ' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧 : ' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介 : ' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
                  }
                }
              }.call(this), a.push("</ul></div></div>"))
            }
          }
        }.call(this), a.push('</div><div class="match-show-vote-title male"><i class="sex-icon i30"></i>男性角色</div><div class="match-show-vote-wrapper clearfix male">'), function() {
          var e = l;
          if ("number" == typeof e.length) for (var s = 0, o = e.length; s < o; s++) {
            var r = e[s];
            0 == r.sex && (a.push('<div class="match-show-vote match-final-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix rolelist-list-final">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧:' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介:' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧:' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介:' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
                }
              }
            }.call(this), a.push("</ul></div></div>"))
          } else {
            var o = 0;
            for (var s in e) {
              o++;
              var r = e[s];
              0 == r.sex && (a.push('<div class="match-show-vote match-final-vote"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div>' + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix rolelist-list-final">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧:' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介:' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img">'), o.big_cover && a.push("<img" + i.attr("src", "" + o.big_cover, !0, !0) + ">"), o.big_cover || a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">"), a.push('<div class="rolelist-selected"><i></i></div></div><div class="rolelist-list-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + '</div><div class="rolelist-list-bangumi">番剧:' + i.escape(null == (t = o.title) ? "" : t) + "</div>"), "" != o.evaluate && a.push('<div class="rolelist-list-detail">简介:' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div>"), a.push('</li><div class="vs">vs</div>')
                  }
                }
              }.call(this), a.push("</ul></div></div>"))
            }
          }
        }.call(this), a.push("</div></div>")
      }.call(this, "title" in s ? s.title : "undefined" != typeof title ? title : void 0, "undefined" in s ? s.undefined : void 0, "voteGroups" in s ? s.voteGroups : "undefined" != typeof voteGroups ? voteGroups : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r, c, v, n) {
        if (a.push('<div class="vote-float-top"></div><div class="container-row vote-select-normal match-show-float"><div class="vote-select-list-wrapper">'), n)(function() {
          var e = n;
          if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
            var o = e[s];
            o.list.length > 0 ?
              function() {
                var e = o.list;
                if ("number" == typeof e.length) for (var l = 0, r = e.length; l < r; l++) {
                  var c = e[l];
                  1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                } else {
                  var r = 0;
                  for (var l in e) {
                    r++;
                    var c = e[l];
                    1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                  }
                }
              }.call(this) : a.push('<div class="vote-select-list"><div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
          } else {
            var l = 0;
            for (var s in e) {
              l++;
              var o = e[s];
              o.list.length > 0 ?
                function() {
                  var e = o.list;
                  if ("number" == typeof e.length) for (var l = 0, r = e.length; l < r; l++) {
                    var c = e[l];
                    1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                  } else {
                    var r = 0;
                    for (var l in e) {
                      r++;
                      var c = e[l];
                      1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                    }
                  }
                }.call(this) : a.push('<div class="vote-select-list"><div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
            }
          }
        }).call(this);
        else for (var d = e(".match-show-vote").length, u = 0; u < d; u++) for (var h = 0; h < v[u];) l["s" + u].length > 0 ? (0 == l["s" + u][0].sex && a.push('<div class="vote-select-list vote-select-list-male">'), 1 == l["s" + u][0].sex && a.push('<div class="vote-select-list vote-select-list-female">')) : a.push('<div class="vote-select-list">'), a.push('<div class="vote-select-list-title">组' + i.escape(null == (t = u + 1) ? "" : t) + '</div><ul class="clearfix">'), l["s" + u] && l["s" + u][h] ? a.push("<li" + i.attr("data-id", "" + l["s" + u][h].character_id, !0, !0) + "><img" + i.attr("src", "" + l["s" + u][h].cover, !0, !0) + "></li>") : a.push("<li></li>"), a.push("</ul></div>"), h++;
        a.push('</div><div class="vote-btn-wrapper"><div class="vote-btn-bg">'), n ? a.push('<div class="vote-btn normal voted"></div>') : a.push('<div class="vote-btn normal"></div>'), a.push('</div><div class="vote-change vote-change-reallove"></div></div></div>'), r ? a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg"><div class="vote-btn reallove voted"></div></div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img"><img' + i.attr("src", "" + r.cover, !0, !0) + '></div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status voted">当前真爱票状态：<span>已用</span></div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>') : (a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg">'), n ? a.push('<div class="vote-btn normal voted"></div>') : a.push('<div class="vote-btn reallove"></div>'), a.push('</div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img">'), o.cover ? a.push("<img" + i.attr("src", "" + o.cover, !0, !0) + ">") : a.push('<img src="">'), a.push('</div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status">当前真爱票状态：'), 1 == s ? a.push("<span>未用</span>") : a.push("<span>未领</span>"), a.push('</div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>'))
      }.call(this, "$" in s ? s.$ : "undefined" != typeof $ ? $ : void 0, "got_tl_ticket" in s ? s.got_tl_ticket : "undefined" != typeof got_tl_ticket ? got_tl_ticket : void 0, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "reallove" in s ? s.reallove : "undefined" != typeof reallove ? reallove : void 0, "tl_chara" in s ? s.tl_chara : "undefined" != typeof tl_chara ? tl_chara : void 0, "undefined" in s ? s.undefined : void 0, "voteNum" in s ? s.voteNum : "undefined" != typeof voteNum ? voteNum : void 0, "votes" in s ? s.votes : "undefined" != typeof votes ? votes : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l) {
        a.push('<div class="container-row vote-info-wrapper"><h1>' + i.escape(null == (t = e) ? "" : t) + '</h1><div class="vote-info-rule"><ul><li>1决赛投票规则：</li><li>1、每组可选择1位进行投票，可不选</li><li>2、使用真爱票时只能选择1位真爱角色进行投票</li><li>3、每天只可进行一次投票，请珍惜投票机会</li></ul></div><div class="vote-info-ticket"></div></div><div class="container-row">'), function() {
          var e = l;
          if ("number" == typeof e.length) for (var s = 0, o = e.length; s < o; s++) {
            var r = e[s];
            a.push('<div class="match-show-vote match-final-vote-jp"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
              var e = r.characters;
              if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                var o = e[s];
                s < 2 && (a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.static_cover, !0, !0) + '><div class="rolelist-list-img-float"><div class="rolelist-list-img-float-bg"><div class="rolelist-list-img-logo"></div></div></div></div><div class="rolelist-list-detail"><div class="rolelist-list-name">'), "0" == s ? a.push('<i class="rolelist-list-i"></i>' + i.escape(null == (t = o.chn_name) ? "" : t)) : a.push("" + i.escape(null == (t = o.chn_name) ? "" : t) + '<i class="rolelist-list-i"></i>'), a.push('</div><div class="rolelist-list-bangumi">番剧：' + i.escape(null == (t = o.title) ? "" : t) + '</div><div class="rolelist-list-profile">简介：' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div></div></li>"))
              } else {
                var l = 0;
                for (var s in e) {
                  l++;
                  var o = e[s];
                  s < 2 && (a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.static_cover, !0, !0) + '><div class="rolelist-list-img-float"><div class="rolelist-list-img-float-bg"><div class="rolelist-list-img-logo"></div></div></div></div><div class="rolelist-list-detail"><div class="rolelist-list-name">'), "0" == s ? a.push('<i class="rolelist-list-i"></i>' + i.escape(null == (t = o.chn_name) ? "" : t)) : a.push("" + i.escape(null == (t = o.chn_name) ? "" : t) + '<i class="rolelist-list-i"></i>'), a.push('</div><div class="rolelist-list-bangumi">番剧：' + i.escape(null == (t = o.title) ? "" : t) + '</div><div class="rolelist-list-profile">简介：' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div></div></li>"))
                }
              }
            }.call(this), a.push("</ul></div></div>")
          } else {
            var o = 0;
            for (var s in e) {
              o++;
              var r = e[s];
              a.push('<div class="match-show-vote match-final-vote-jp"><div class="rolelist-title"><div class="group-checkbox-wrapper"><input type="checkbox" class="group-checkbox"><div class="group-checkbox-status"></div></div><span class="group-num">组' + i.escape(null == (t = s + 1) ? "" : t) + "</span>" + i.escape(null == (t = r.group_name) ? "" : t) + '</div><div class="rolelist-list"><ul class="clearfix">'), function() {
                var e = r.characters;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  s < 2 && (a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.static_cover, !0, !0) + '><div class="rolelist-list-img-float"><div class="rolelist-list-img-float-bg"><div class="rolelist-list-img-logo"></div></div></div></div><div class="rolelist-list-detail"><div class="rolelist-list-name">'), "0" == s ? a.push('<i class="rolelist-list-i"></i>' + i.escape(null == (t = o.chn_name) ? "" : t)) : a.push("" + i.escape(null == (t = o.chn_name) ? "" : t) + '<i class="rolelist-list-i"></i>'), a.push('</div><div class="rolelist-list-bangumi">番剧：' + i.escape(null == (t = o.title) ? "" : t) + '</div><div class="rolelist-list-profile">简介：' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div></div></li>"))
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    s < 2 && (a.push("<li" + i.attr("data-id", "" + o.character_id, !0, !0) + i.attr("data-cover", "" + o.cover, !0, !0) + i.attr("data-name", "" + o.chn_name, !0, !0) + i.attr("data-group", "" + r.group_id, !0, !0) + i.attr("data-sex", "" + r.sex, !0, !0) + i.attr("data-season", "" + o.title, !0, !0) + '><div class="rolelist-list-img"><img' + i.attr("src", "" + o.static_cover, !0, !0) + '><div class="rolelist-list-img-float"><div class="rolelist-list-img-float-bg"><div class="rolelist-list-img-logo"></div></div></div></div><div class="rolelist-list-detail"><div class="rolelist-list-name">'), "0" == s ? a.push('<i class="rolelist-list-i"></i>' + i.escape(null == (t = o.chn_name) ? "" : t)) : a.push("" + i.escape(null == (t = o.chn_name) ? "" : t) + '<i class="rolelist-list-i"></i>'), a.push('</div><div class="rolelist-list-bangumi">番剧：' + i.escape(null == (t = o.title) ? "" : t) + '</div><div class="rolelist-list-profile">简介：' + i.escape(null == (t = o.evaluate) ? "" : t) + "</div></div></li>"))
                  }
                }
              }.call(this), a.push("</ul></div></div>")
            }
          }
        }.call(this), a.push("</div>")
      }.call(this, "title" in s ? s.title : "undefined" != typeof title ? title : void 0, "undefined" in s ? s.undefined : void 0, "voteGroups" in s ? s.voteGroups : "undefined" != typeof voteGroups ? voteGroups : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r, c, v, n, d) {
        if (a.push('<div class="vote-float-top"></div><div class="container-row vote-select-normal match-show-float match-final-float-jp"><div class="vote-select-list-wrapper">'), d)(function() {
          var e = d;
          if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
            var o = e[s];
            o.list.length > 0 ?
              function() {
                var e = o.list;
                if ("number" == typeof e.length) for (var l = 0, r = e.length; l < r; l++) {
                  var c = e[l];
                  1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), 3 == c.character.sex && a.push('<div class="vote-select-list">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                } else {
                  var r = 0;
                  for (var l in e) {
                    r++;
                    var c = e[l];
                    1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), 3 == c.character.sex && a.push('<div class="vote-select-list">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                  }
                }
              }.call(this) : a.push('<div class="vote-select-list"><div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
          } else {
            var l = 0;
            for (var s in e) {
              l++;
              var o = e[s];
              o.list.length > 0 ?
                function() {
                  var e = o.list;
                  if ("number" == typeof e.length) for (var l = 0, r = e.length; l < r; l++) {
                    var c = e[l];
                    1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), 3 == c.character.sex && a.push('<div class="vote-select-list">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                  } else {
                    var r = 0;
                    for (var l in e) {
                      r++;
                      var c = e[l];
                      1 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-female">'), 0 == c.character.sex && a.push('<div class="vote-select-list vote-select-list-male">'), 3 == c.character.sex && a.push('<div class="vote-select-list">'), a.push('<div class="vote-select-list-title float-checked">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li' + i.attr("data-id", "" + c.character.character_id, !0, !0) + "><img" + i.attr("src", "" + c.character.cover, !0, !0) + "></li></ul></div>")
                    }
                  }
                }.call(this) : a.push('<div class="vote-select-list"><div class="vote-select-list-title">组' + i.escape(null == (t = s + 1) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
            }
          }
        }).call(this);
        else for (var u = e(".match-show-vote").length, h = 0; h < u; h++) for (var p = 0; p < n[h];) o["s" + h].length > 0 ? (0 == o["s" + h][0].sex && a.push('<div class="vote-select-list vote-select-list-male">'), 1 == o["s" + h][0].sex && a.push('<div class="vote-select-list vote-select-list-female">'), 2 == o["s" + h][0].sex && a.push('<div class="vote-select-list">')) : a.push('<div class="vote-select-list">'), a.push('<div class="vote-select-list-title">组' + i.escape(null == (t = h + 1) ? "" : t) + '</div><ul class="clearfix">'), o["s" + h] && o["s" + h][p] ? a.push("<li" + i.attr("data-id", "" + o["s" + h][p].character_id, !0, !0) + "><img" + i.attr("src", "" + o["s" + h][p].cover, !0, !0) + "></li>") : a.push("<li></li>"), a.push("</ul></div>"), p++;
        a.push('</div><div class="vote-btn-wrapper"><div class="vote-btn-bg">'), d ? a.push('<div class="vote-btn normal voted"></div>') : a.push('<div class="vote-btn normal"></div>'), a.push("</div>"), 2 == s.match_type ? a.push('<div class="vote-change vote-change-reallove"></div>') : a.push('<div class="vote-change vote-change-reallove not-allow"></div>'), a.push("</div></div>"), 2 == s.match_type && (c ? a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg"><div class="vote-btn reallove voted"></div></div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img"><img' + i.attr("src", "" + c.cover, !0, !0) + '></div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status voted">当前真爱票状态：<span>已用</span></div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>') : (a.push('<div class="container-row vote-select-reallove"><div class="vote-btn-wrapper"><div class="vote-btn-bg"><div class="vote-btn reallove"></div></div><div class="vote-change vote-change-normal"></div></div><div class="vote-reallove-wrapper"><i></i><div class="vote-reallove-img">'), r.cover ? a.push("<img" + i.attr("src", "" + r.cover, !0, !0) + ">") : a.push('<img src="">'), a.push('</div></div><div class="vote-reallove-rule-wrapper"><ul><li>注意事项：</li><li>1、通过分享可获得并只可获得一张真爱票</li><li>2、赛程全阶段任意一场可用</li><li>3、使用真爱票后该票计为两张</li></ul></div><div class="vote-reallove-status-wrapper"><div class="vote-reallove-status">当前真爱票状态：'), 1 == l ? a.push("<span>未用</span>") : a.push("<span>未领</span>"), a.push('</div><div class="share-btn-wrapper">用分享为喜欢的角色拉票吧~<br><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div>')))
      }.call(this, "$" in s ? s.$ : "undefined" != typeof $ ? $ : void 0, "ajaxOpt" in s ? s.ajaxOpt : "undefined" != typeof ajaxOpt ? ajaxOpt : void 0, "got_tl_ticket" in s ? s.got_tl_ticket : "undefined" != typeof got_tl_ticket ? got_tl_ticket : void 0, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "reallove" in s ? s.reallove : "undefined" != typeof reallove ? reallove : void 0, "tl_chara" in s ? s.tl_chara : "undefined" != typeof tl_chara ? tl_chara : void 0, "undefined" in s ? s.undefined : void 0, "voteNum" in s ? s.voteNum : "undefined" != typeof voteNum ? voteNum : void 0, "votes" in s ? s.votes : "undefined" != typeof votes ? votes : void 0), a.join("")
    }
  }, function(e, t, a) {
    var i = a(5);
    e.exports = function(e) {
      var t, a = [],
        s = e || {};
      return function(e, s, l, o, r) {
        if ("2" == e.area ? a.push('<div class="vote-popupbox-wrapper voted vote-voted-content-jp">') : a.push('<div class="vote-popupbox-wrapper voted">'), "normal" == o) {
          a.push('<!-- 普通投票--><div class="vote-popupbox vote-normal-ticket"><div class="vote-voted-title">您已成功参与今天的投票！</div><div class="vote-voted-content"><div class="vote-normal-ticket-list clearfix">');
          var c = 0;
          (function() {
            var e = s;
            if ("number" == typeof e.length) for (var l = 0, o = e.length; l < o; l++) {
              var r = e[l];
              r.length > 0 ? (a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title">组' + i.escape(null == (t = ++c) ? "" : t) + '</div><ul class="clearfix">'), function() {
                var e = r;
                if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                  var o = e[s];
                  a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                } else {
                  var l = 0;
                  for (var s in e) {
                    l++;
                    var o = e[s];
                    a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                  }
                }
              }.call(this), a.push("</ul></div>")) : a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title noselect">组' + i.escape(null == (t = ++c) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
            } else {
              var o = 0;
              for (var l in e) {
                o++;
                var r = e[l];
                r.length > 0 ? (a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title">组' + i.escape(null == (t = ++c) ? "" : t) + '</div><ul class="clearfix">'), function() {
                  var e = r;
                  if ("number" == typeof e.length) for (var s = 0, l = e.length; s < l; s++) {
                    var o = e[s];
                    a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                  } else {
                    var l = 0;
                    for (var s in e) {
                      l++;
                      var o = e[s];
                      a.push('<li><div class="vote-normal-ticket-img"><img' + i.attr("src", "" + o.cover, !0, !0) + "></div><div" + i.attr("title", "" + o.chn_name, !0, !0) + ' class="vote-normal-ticket-name">' + i.escape(null == (t = o.chn_name) ? "" : t) + "</div></li>")
                    }
                  }
                }.call(this), a.push("</ul></div>")) : a.push('<div class="show-vote-normal-group"><div class="vote-normal-ticket-list-title noselect">组' + i.escape(null == (t = ++c) ? "" : t) + '</div><ul class="clearfix"><li></li></ul></div>')
              }
            }
          }).call(this), a.push('</div><div class="vote-voted-share"><div class="vote-voted-shares-text">你对角色的爱已经成功传达出去！<br>叫上你的好基友一起来参与吧！</div><div class="vote-voted-share-btns"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div><div class="vote-voted-btns"><div class="vote-voted-btn-result"></div><div class="vote-voted-btn-home"></div></div></div>')
        }
        "reallove" == o && l.cover && (a.push('<div class="vote-popupbox vote-reallove-ticket"><div class="vote-voted-title">您已成功参与今天的投票！</div><div class="vote-voted-content"><div class="vote-reallove-ticket-content"><div class="vote-reallove-ticket-title"><i></i>真爱票</div>'), 0 == l.sex ? a.push('<div class="vote-reallove-ticket-info male clearfix"><div class="vote-reallove-ticket-img"><img' + i.attr("src", "" + l.cover, !0, !0) + '></div><div class="vote-reallove-ticket-text"><div class="vote-reallove-ticket-sex"><i class="sex-icon i22"></i>男性角色</div><div class="vote-reallove-ticket-name">' + i.escape(null == (t = l.chn_name) ? "" : t) + '</div><div class="vote-reallove-ticket-anime">' + i.escape(null == (t = l.season) ? "" : t) + "</div></div></div>") : a.push('<div class="vote-reallove-ticket-info female clearfix"><div class="vote-reallove-ticket-img"><img' + i.attr("src", "" + l.cover, !0, !0) + '></div><div class="vote-reallove-ticket-text"><div class="vote-reallove-ticket-sex"><i class="sex-icon i22"></i>女性角色</div><div class="vote-reallove-ticket-name">' + i.escape(null == (t = l.chn_name) ? "" : t) + '</div><div class="vote-reallove-ticket-anime">' + i.escape(null == (t = l.season) ? "" : t) + "</div></div></div>"), a.push('</div><div class="vote-reallove-ticket-tips"><ul><li>注意：</li><li>1、您已使用真爱票，该票所选角色计为两票</li><li>2、您的真爱票资格已用完</li></ul></div><div class="vote-voted-share"><div class="vote-voted-shares-text">你对角色的爱已经成功传达出去！<br>叫上你的好基友一起来参与吧！</div><div class="vote-voted-share-btns"><div data-id="btn_baidu" class="share-btn share-baidu"></div><div data-id="btn_qqzone" class="share-btn share-qzone"></div><div data-id="btn_weixin" class="share-btn share-wchat"></div><div data-id="btn_weibo" class="share-btn share-weibo"></div></div></div></div><div class="vote-voted-btns"><div class="vote-voted-btn-result"></div><div class="vote-voted-btn-home"></div></div></div>')), a.push("</div>")
      }.call(this, "ajaxOpt" in s ? s.ajaxOpt : "undefined" != typeof ajaxOpt ? ajaxOpt : void 0, "normallist" in s ? s.normallist : "undefined" != typeof normallist ? normallist : void 0, "reallove" in s ? s.reallove : "undefined" != typeof reallove ? reallove : void 0, "state" in s ? s.state : "undefined" != typeof state ? state : void 0, "undefined" in s ? s.undefined : void 0), a.join("")
    }
  }]);