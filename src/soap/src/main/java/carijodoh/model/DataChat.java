package carijodoh.model;

import java.util.ArrayList;
import java.util.List;

public class DataChat {
    private List<Chat> data;

    public DataChat() {
        this.data = new ArrayList<>();
    }

    public List<Chat> getData() {
        return data;
    }

    public void setData(List<Chat> data) {
        this.data = data;
    }

    public void addData(Chat el) {
        this.data.add(el);
    }
}
