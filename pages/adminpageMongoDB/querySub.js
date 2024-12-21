
const session = db.getMongo().startSession();

try {
    session.startTransaction();

    const productCollection = session.getDatabase("sportshop").product;
    const orderCollection = session.getDatabase("sportshop").orders;

    const avgPriceResult = orderCollection.aggregate([
        { $group: { _id: null, avgPriceSell: { $avg: "$price_sell" } } }
    ]).toArray();

    if (avgPriceResult.length === 0) {
        session.abortTransaction();
        print("Không tìm thấy dữ liệu trong bảng orders.");
    } else {
        const avgPriceSell = avgPriceResult[0].avgPriceSell;

        const result = productCollection.find(
            { price: { $gt: avgPriceSell } },
        ).toArray();

        if (result.length > 0) {

            print("Kết quả tìm kiếm:");
            result.forEach(doc => printjson(doc));
            session.commitTransaction();
        } else {

            session.abortTransaction();
            print("Không tìm thấy sản phẩm nào phù hợp.");
        }
    }
} catch (error) {
    session.abortTransaction();
    print("Lỗi xảy ra trong quá trình thực thi:", error.message);
} finally {
    session.endSession();
}
