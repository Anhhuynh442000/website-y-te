import ReactDOM from 'react-dom';
import React from 'react';
import { Paginated } from '../../components/Pagination/Paginated';
import { getTotalBlog } from './service/services';

const SELECTOR_DELETE_MODAL = '#deleteBlogModal';
const SELECTOR_DELETE_LINK = '.js-delete-blog-link';
const SELECTOR_CANCEL_BUTTON = '.js-btn-cancel';
const SELECTOR_FORM = '#delete-blog-form';
const SELECTOR_BLOG_TITLE = '.js-blog-title';
const SELECTOR_INPUT_ID = 'input[name="blog-id"]';

export default class BlogList {
    private $modal: any;
    private $deleteLink: JQuery<HTMLAnchorElement>;
    private $cancelButton: JQuery<HTMLButtonElement>;
    private $form: JQuery<HTMLFormElement>;

    constructor() {
        this.$modal = $(SELECTOR_DELETE_MODAL);
        this.$deleteLink = $(SELECTOR_DELETE_LINK);
        this.$cancelButton = $(SELECTOR_CANCEL_BUTTON);
        this.$form = $(SELECTOR_FORM);
    }

    private bindEvent() {
        this.$deleteLink.on('click', event => {
            const id = $(event.currentTarget).data('blog-id');
            const title = $(event.currentTarget).data('blog-title');
            this.handleDelete(id, title);
        });
        this.$cancelButton.on('click', event => {
            event.preventDefault();
            this.handleCancel();
        });
    }

    private handleDelete(id: string, fullName: string) {
        this.$modal.find(SELECTOR_BLOG_TITLE).text(fullName);
        this.$form.find(SELECTOR_INPUT_ID).attr('value', id);
        this.$modal.modal('show');
    }

    private handleCancel() {
        this.$modal.modal('hide');
    }

    private renderPagination() {
        ReactDOM.render(
            React.createElement(Paginated, {
                itemsPerPage: 10,
                path: '/admin/blog-list',
                service: getTotalBlog
            }),
            document.getElementById('pagination')
        );
    }

    public render() {
        this.renderPagination();
        this.bindEvent();
    }
}
