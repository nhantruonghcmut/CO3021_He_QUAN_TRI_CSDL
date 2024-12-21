
const session = db.getMongo().startSession();

try {
    session.startTransaction();

    const productCollection = session.getDatabase("sportshop").product;

    const result = productCollection.aggregate([
        {
            $lookup: {
                from: "orders",
                localField: "id",
                foreignField: "productId",
                as: "orderDetails"
            }
        },
        {
            $match: {
                orderDetails: { $size: 0 }
            }
        }
    ]).toArray();

    if (result.length > 0) {

        print("Kết quả tìm kiếm:");
        result.forEach(doc => printjson(doc));
        session.commitTransaction();
    } else {

        session.abortTransaction();
        print("Không tìm thấy sản phẩm nào phù hợp.");
    }
} catch (error) {

    session.abortTransaction();
    print("Lỗi xảy ra trong quá trình thực thi:", error.message);
} finally {
    session.endSession();
}
