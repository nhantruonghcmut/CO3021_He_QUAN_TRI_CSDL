const session = db.getMongo().startSession();

try {
    session.startTransaction();
    const productCollection = session.getDatabase("sportshop").product;
    const keyword = "Phượt";
    const priceCondition = 83000;
    const regex = new RegExp(keyword, 'i'); 
    const result = productCollection.find({
        $and:[
            {
                $or: [
                    { name: regex },
                    { description: regex },
                    { quantity: regex }
                ]
            },
            { price: { $gt: priceCondition } }
        ]
    }).toArray();

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
