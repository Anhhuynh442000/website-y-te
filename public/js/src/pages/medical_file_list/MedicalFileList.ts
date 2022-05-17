import { getTotalMedicalFile, searchMedicalFile } from './services/services';
import { createUrl } from '../../components/url/url';
import ReactDOM from 'react-dom';
import React from 'react';
import { Paginated } from '../../components/Pagination/Paginated';

const SELECTOR_DELETE_MODAL = '#deleteMedicalFileModal';
const SELECTOR_DELETE_LINK = '.js-delete-medical-file';
const SELECTOR_FORM = '#delete-medical-file-form';
const SELECTOR_FULL_NAME = '.js-medical-file-full-name';
const SELECTOR_INPUT_ID = 'input[name="medical-file-id"]';
const SELECTOR_CANCEL_BUTTON = '.js-btn-cancel';
const SELECTOR_SEARCH_RESULT = '.js-search-result';
const SELECTOR_SEARCH_INPUT = 'input[name="search"]';

export default class MedicalFileList {
    private $modal: any;
    private $deleteLink: JQuery<HTMLAnchorElement>;
    private $form: JQuery<HTMLFormElement>;
    private $cancelButton: JQuery<HTMLButtonElement>;
    private $searchResult: JQuery<HTMLDivElement>;

    constructor() {
        this.$modal = $(SELECTOR_DELETE_MODAL);
        this.$deleteLink = $(SELECTOR_DELETE_LINK);
        this.$cancelButton = $(SELECTOR_CANCEL_BUTTON);
        this.$form = $(SELECTOR_FORM);
        this.$searchResult = $(SELECTOR_SEARCH_RESULT);
    }

    private bindEvent() {
        this.$deleteLink.on('click', event => {
            const id = $(event.currentTarget).data('medical-file-id');
            const fullName = $(event.currentTarget).data('medical-file-name');
            this.handleDelete(id, fullName);
        });
        this.$cancelButton.on('click', event => {
            event.preventDefault();
            this.handleCancel();
        });
        $(SELECTOR_SEARCH_INPUT).on('keyup', e => {
            const keyWord = $(e.currentTarget).val();
            this.handleSearch(keyWord as string);
        });
        $(document).on('click', () => {
            this.$searchResult.hide();
        });
    }

    private handleSearch(keyWord: string) {
        searchMedicalFile(keyWord).then(result => {
            let list = '';
            result.data.forEach(item => {
                const url = createUrl('admin/medical-file-detail', {
                    id: item.id
                });
                list += `<li><a href="${url}"><span>${item.full_name} - ${item.phone}</span></a></li>`;
            });
            this.$searchResult.html(list);
            this.$searchResult.show();
        });
    }

    private handleDelete(id: string, fullName: string) {
        this.$modal.find(SELECTOR_FULL_NAME).text(fullName);
        this.$form.find(SELECTOR_INPUT_ID).attr('value', id);
        this.$modal.modal('show');
    }

    private handleCancel() {
        this.$modal.modal('hide');
    }

    private pagination() {
        ReactDOM.render(
            React.createElement(Paginated, {
                itemsPerPage: 10,
                path: '/admin/medical-file-list',
                service: getTotalMedicalFile
            }),
            document.getElementById('pagination')
        );
    }

    public render() {
        this.bindEvent();
        this.pagination();
    }
}
