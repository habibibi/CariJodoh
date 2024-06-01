package carijodoh.model;

import java.util.ArrayList;
import java.util.List;

public class DataPagination {
    private int pageCount;
    private List<Article> data;

    public DataPagination() {
        this.pageCount = 0;
        this.data = new ArrayList<>();
    }

    public int getPageCount() {
        return pageCount;
    }

    public void setPageCount(int pageCount) {
        this.pageCount = pageCount;
    }

    public List<Article> getData() {
        return data;
    }

    public void setData(List<Article> data) {
        this.data = data;
    }

    public void addData(Article el) {
        this.data.add(el);
    }
}
