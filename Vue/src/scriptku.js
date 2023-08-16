export const generate_id=(prefix)=>{
    let tanggal=new Date();
    let tmp=tanggal.getHours()*3600+tanggal.getMinutes()*60+tanggal.getSeconds();
    let id=prefix+String(tanggal.getDate()).padStart(2, '0')
    +String(tanggal.getMonth()).padStart(2, '0')
    +String(tanggal.getFullYear()).padStart(4, '0')
    +tmp+String(Math.floor(Math.random(10)*10)).padStart(2, '0');
    return id;
}