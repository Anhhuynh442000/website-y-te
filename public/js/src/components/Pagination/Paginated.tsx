import { useEffect, useState, VFC } from 'react';
import ReactPaginate from 'react-paginate';
import { AxiosPromise } from 'axios';

interface OnChangeSelectedEvent {
    selected: number;
}

interface PaginatedProps {
    itemsPerPage: number;
    path: string;
    service: () => AxiosPromise;
}

export const Paginated: VFC<PaginatedProps> = ({
    itemsPerPage,
    path,
    service
}) => {
    const [pageCount, setPageCount] = useState(0);
    const [total, setTotal] = useState(0);

    useEffect(() => {
        service().then(response => {
            setTotal(response.data.total);
            setPageCount(Math.ceil(response.data.total / itemsPerPage));
        });
    }, [itemsPerPage]);

    const handlePageClick = (event: OnChangeSelectedEvent) => {
        const newOffset = (event.selected * itemsPerPage) % total;
        window.location.replace(
            `${path}?page=${event.selected + 1}&offset=${newOffset}`
        );
    };

    const currenPage = () => {
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        const pageNumber = url.searchParams.get('page') ?? '1';
        return parseInt(pageNumber) - 1;
    };

    return (
        <>
            <ReactPaginate
                breakLabel="..."
                nextLabel="Next >"
                previousLabel="< Previous"
                pageClassName="page-item"
                pageLinkClassName="page-link"
                previousClassName="page-item"
                previousLinkClassName="page-link"
                nextClassName="page-item"
                nextLinkClassName="page-link"
                breakClassName="page-item"
                breakLinkClassName="page-link"
                containerClassName="pagination"
                activeClassName="active"
                onPageChange={handlePageClick}
                pageRangeDisplayed={5}
                pageCount={pageCount}
                renderOnZeroPageCount={undefined}
                disableInitialCallback={true}
                initialPage={currenPage()}
            />
        </>
    );
};
