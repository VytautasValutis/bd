import 'bootstrap';
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


if (document.querySelector('.--tags')) {

    const tagsDom = document.querySelector('.--tags');
    const addDom = document.querySelector('.--add');

    function initRemoveTag(tag) {
        const tags = tag.closest('.--tags');
        tag.addEventListener('click', _ => {
            axios.put(tags.dataset.url, { tag: tag.dataset.id })
                .then(res => {
                    if (res.data.status == 'ok') {
                        tag.remove();
                    }
                });
        });
    }

    const insertTag = (tagList, res) => {
        console.log(res.data.tag)
        const add = tagList.closest('.--add');
        const bin = tagList.closest('.--tags');
        const div = document.createElement('div');
        div.classList.add('tag');
        div.dataset.id = res.data.id;
        const title = document.createTextNode(res.data.tag);
        div.appendChild(title);
        const i = document.createElement('i');
        div.appendChild(i);
        bin.insertBefore(div, add);
        initRemoveTag(div);
    }

    const initTagList = tagList => {
        tagList.querySelectorAll('.--list--tag')
            .forEach(t => {
                t.addEventListener('click', _ => {
                    console.log(tagList.dataset.url)
                    axios.put(tagList.dataset.url, { tag: t.dataset.id })
                        .then(res => {
                            console.log(res.data.tag)
                            if (res.data.status == 'ok') {
                                insertTag(tagList, res);
                            }
                        });
                });
            });
    }

    tagsDom.querySelector('.--newtag')
        .addEventListener('click', _ => {
                const i = addDom.querySelector('.--add--new');
                const bb = addDom.querySelector('.--newtag');
                axios.post(bb.dataset.url, { tag: i.value })
                    .then(res => {
                        if(res.data.status == 'ok') {
                            insertTag(addDom.querySelector('.--tags--list'), res);
                            console.log(res.data);
                        }
                    });
        })

    document.querySelectorAll('.--add--new')
        .forEach(i => {
            console.log('add--new')
            i.addEventListener('input', e => {
                axios.get(e.target.dataset.url + '?t=' + e.target.value)
                    .then(res => {
                            i.closest('.--add').querySelector('.--tags--list').innerHTML = res.data.tags;
                            initTagList(i.closest('.--add').querySelector('.--tags--list'));
                    });
            });
            i.addEventListener('focus', e => {
                i.closest('.--add').querySelector('.--tags--list').style.display = 'block';
            });
            i.addEventListener('blur', e => {
                setTimeout(() => {
                    e.target.value = '';
                    i.closest('.--add').querySelector('.--tags--list').innerHTML = '';
                    i.closest('.--add').querySelector('.--tags--list').style.display = 'none';
                }, 200);
            });
        });
        
    document.querySelectorAll('.--tags')
        .forEach(tags => {
            tags.querySelectorAll('.--tag')
                .forEach(tag => {
                    initRemoveTag(tag)
                });
        });

}
if (document.querySelector('.--add--gallery')) {
    let g = 0;
    document.querySelector('.--add--gallery')
        .addEventListener('click', _ => {
            const input = document.querySelector('[data-gallery="0"]').cloneNode(true);
            g++;
            input.dataset.gallery = g;
            input.querySelector('input').setAttribute('name', 'galleryH[]');
            input.querySelector('span')
                .addEventListener('click', e => {
                    e.target.closest('.mt-3').remove();
                });
            document.querySelector('.gallery-inputs').append(input);
        });
}

if (document.querySelector('.--create--history')) {
    const histDom = document.querySelector('.--create--history');
    const loader = document.querySelector('.loader');
    const showLoader = _ => loader.style.display = 'flex';
    const hideLoader = _ => loader.style.display = 'none';
    histDom.querySelector('.--ai--button')
        .addEventListener('click', _ => {
            showLoader();
        });
    histDom.addEventListener('load', _ => {
        hideLoader();
    });
}

