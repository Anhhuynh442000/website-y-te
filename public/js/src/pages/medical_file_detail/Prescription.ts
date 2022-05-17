import { getHealth } from '../medical_file_list/services/services';

export default class Prescription {
    private bindEvent() {
        $('.js-edit-prescription').on('click', event => {
            const healthId = $(event.currentTarget).data('health-id');
            this.handleOnClick(healthId);
        });
    }

    private handleOnClick(healthId: string) {
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        const medicalFileId = url.searchParams.get('id');
        getHealth(healthId).then(result => {
            const newUrl = `/admin/prescription-edit?id=${result.data.id}&medical-file-id=${medicalFileId}`;
            window.location.replace(newUrl);
        });
    }

    public render() {
        this.bindEvent();
    }
}
