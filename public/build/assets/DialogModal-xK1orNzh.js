import{S as _}from"./SectionTitle-DyGzn-XG.js";import{e as x,o as u,b as m,a as e,w as i,r as l,d as p,D as b,s as $,x as k,k as B,l as h,z as w,A as v,n as S,f as C,c as E}from"./app-DRP7BpcZ.js";const W={class:"md:grid md:grid-cols-3 md:gap-6"},z={class:"mt-5 md:mt-0 md:col-span-2"},M={class:"px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg"},U={__name:"ActionSection",setup(t){return(a,s)=>(u(),x("div",W,[m(_,null,{title:i(()=>[l(a.$slots,"title")]),description:i(()=>[l(a.$slots,"description")]),_:3}),e("div",z,[e("div",M,[l(a.$slots,"content")])])]))}},D={class:"fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50","scroll-region":""},N={__name:"Modal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(t,{emit:a}){const s=t,r=a,o=p(),d=p(s.show);b(()=>s.show,()=>{var n;s.show?(document.body.style.overflow="hidden",d.value=!0,(n=o.value)==null||n.showModal()):(document.body.style.overflow=null,setTimeout(()=>{var c;(c=o.value)==null||c.close(),d.value=!1},200))});const f=()=>{s.closeable&&r("close")},y=n=>{n.key==="Escape"&&s.show&&f()};$(()=>document.addEventListener("keydown",y)),k(()=>{document.removeEventListener("keydown",y),document.body.style.overflow=null});const g=B(()=>({sm:"sm:max-w-sm",md:"sm:max-w-md",lg:"sm:max-w-lg",xl:"sm:max-w-xl","2xl":"sm:max-w-2xl"})[s.maxWidth]);return(n,c)=>(u(),x("dialog",{class:"z-50 m-0 min-h-full min-w-full overflow-y-auto bg-transparent backdrop:bg-transparent",ref_key:"dialog",ref:o},[e("div",D,[m(v,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0","enter-to-class":"opacity-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:i(()=>[h(e("div",{class:"fixed inset-0 transform transition-all",onClick:f},c[0]||(c[0]=[e("div",{class:"absolute inset-0 bg-gray-500 opacity-75"},null,-1)]),512),[[w,t.show]])]),_:1}),m(v,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to-class":"opacity-100 translate-y-0 sm:scale-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100 translate-y-0 sm:scale-100","leave-to-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:i(()=>[h(e("div",{class:S(["mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto",g.value])},[d.value?l(n.$slots,"default",{key:0}):C("",!0)],2),[[w,t.show]])]),_:3})])],512))}},T={class:"px-6 py-4"},V={class:"text-lg font-medium text-gray-900"},A={class:"mt-4 text-sm text-gray-600"},L={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-end"},q={__name:"DialogModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(t,{emit:a}){const s=a,r=()=>{s("close")};return(o,d)=>(u(),E(N,{show:t.show,"max-width":t.maxWidth,closeable:t.closeable,onClose:r},{default:i(()=>[e("div",T,[e("div",V,[l(o.$slots,"title")]),e("div",A,[l(o.$slots,"content")])]),e("div",L,[l(o.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}};export{N as _,U as a,q as b};
